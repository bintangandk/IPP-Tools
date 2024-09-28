<?php

namespace App\Http\Controllers;

use App\Exports\RegisteredPartnerExport;
use App\Imports\RegisteredPartnerImport;
use App\Models\RegisteredPartner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredPartnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $registered_partner = RegisteredPartner::query();

        if ($user->level == 'Admin') {
            $circle = RegisteredPartner::distinct()->pluck('circle');
            $region = RegisteredPartner::distinct()->pluck('region');
            $area = RegisteredPartner::distinct()->pluck('kabupaten');
            $sales_area = RegisteredPartner::distinct()->pluck('kecamatan');
            if (request()->filled('circle') && request('circle') != 'semua') {
                $registered_partner->where('circle', request('circle'));
            }
            if (request()->filled('region') && request('region') != 'semua') {
                $registered_partner->where('region', request('region'));
            }
            if (request()->filled('area') && request('area') != 'semua') {
                $registered_partner->where('kabupaten', request('area'));
            }
            if (request()->filled('sales_area') && request('sales_area') != 'semua') {
                $registered_partner->where('kecamatan', request('sales_area'));
            }
            if (request()->has('export')) {
                return Excel::download(new RegisteredPartnerExport(request('circle'), request('region'), request('area'), request('sales_area'), $user->level), 'registered_partner.xlsx');
            }
        } else {
            $circle = RegisteredPartner::distinct()->where('region', $user->region)->pluck('circle');
            $region = RegisteredPartner::distinct()->where('region', $user->region)->pluck('region');
            $area = RegisteredPartner::distinct()->where('region', $user->region)->pluck('kabupaten');
            $sales_area = RegisteredPartner::distinct()->where('region', $user->region)->pluck('kecamatan');
            $registered_partner->where('region', '=', $user->region);

            if (request()->filled('circle') && request('circle') != 'semua') {
                $registered_partner->where('circle', request('circle'));
            }
            if (request()->filled('area') && request('area') != 'semua') {
                $registered_partner->where('kabupaten', request('area'));
            }
            if (request()->filled('sales_area') && request('sales_area') != 'semua') {
                $registered_partner->where('kecamatan', request('sales_area'));
            }
            if (request()->has('export')) {
                return Excel::download(new RegisteredPartnerExport(request('circle'), request('region'), request('area'), request('sales_area'), $user->level), 'registered_partner.xlsx');
            }
        }
        $registered_partner = $registered_partner->get();
        return view('page.registered-partner.data-partner')->with([
            'title' => 'Data Partner',
            'registered_partner' => $registered_partner,
            'circle' => $circle,
            'region' => $region,
            'area' => $area,
            'sales_area' => $sales_area
        ]);
    }

    public function create()
    {
        return view('page.registered-partner.create-partner')->with([
            'title' => 'Create New Partner',
        ]);
    }

    public function createPost(Request $request){
        try {
            request()->validate([
                'submission_date' => 'required|date',
                'circle' => 'required',
                'region' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'im3_outlet_id' => 'required',
                'im3_outlet_name' => 'required',
                'qr_code' => 'required',
                'outlet_name' => 'required',
            ]);

            $registered_partner = new RegisteredPartner();
            $registered_partner->submission_date = $request->submission_date;
            $registered_partner->circle = $request->circle;
            $registered_partner->region = $request->region;
            $registered_partner->kecamatan = $request->kecamatan;
            $registered_partner->kabupaten = $request->kabupaten;
            $registered_partner->longitude = $request->longitude;
            $registered_partner->latitude = $request->latitude;
            $registered_partner->im3_outlet_id = $request->im3_outlet_id;
            $registered_partner->im3_outlet_name = $request->im3_outlet_name;
            $registered_partner->qr_code = $request->qr_code;
            $registered_partner->outlet_name = $request->outlet_name;
            $registered_partner->save();
            Alert::success('Berhasil', 'Data Berhasil Di Simpan!');
            return redirect()->route('registered-partner.index');
        } catch(Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function import(Request $request)
    {
        try {
            // Cek file
            if ($request->file('file')->isValid()) {
                Log::info('File is valid: ' . $request->file('file')->getClientOriginalName());
            }

            // Impor data
            Excel::import(new RegisteredPartnerImport, $request->file('file'));

            Alert::success('Berhasil', 'Data Berhasil Di Import!');
            return back();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Mengambil kesalahan dari validasi
            $errors = [];
            foreach ($e->failures() as $failure) {
                $errors[] = [
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                ];
            }

            Log::error('Validation error: ' . json_encode($errors));
            return redirect()->back()->with('error', 'Kesalahan validasi: ' . implode(", ", array_map(function ($error) {
                return 'Baris ' . $error['row'] . ': ' . implode(", ", $error['errors']);
            }, $errors)));
        } catch (Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengimpor data. Silakan coba lagi.');
        }
    }

    public function edit($im3_outlet_id) {
        $id_dec = Crypt::decrypt($im3_outlet_id);
        $registered_partner = RegisteredPartner::where('im3_outlet_id', $id_dec)->first();
        return view('page.registered-partner.edit-partner')->with([
            'title' => 'Edit Partner',
            'partner' => $registered_partner,
            'id_dec' => $id_dec
        ]);
    }

    public function editPost(Request $request, $im3_outlet_id) {
        try {
            request()->validate([
                'submission_date' => 'required|date',
                'circle' => 'required',
                'region' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'im3_outlet_id' => 'required',
                'im3_outlet_name' => 'required',
                'qr_code' => 'required',
                'outlet_name' => 'required',
            ]);
            $registered_partner = RegisteredPartner::where('im3_outlet_id', $im3_outlet_id)->first();
            $registered_partner->submission_date = $request->submission_date;
            $registered_partner->circle = $request->circle;
            $registered_partner->region = $request->region;
            $registered_partner->kecamatan = $request->kecamatan;
            $registered_partner->kabupaten = $request->kabupaten;
            $registered_partner->longitude = $request->longitude;
            $registered_partner->latitude = $request->latitude;
            $registered_partner->im3_outlet_id = $request->im3_outlet_id;
            $registered_partner->im3_outlet_name = $request->im3_outlet_name;
            $registered_partner->qr_code = $request->qr_code;
            $registered_partner->outlet_name = $request->outlet_name;
            $registered_partner->save();
            Alert::success('Berhasil', 'Data Berhasil Di Update!');
            return redirect()->route('registered-partner.index');
        } catch(Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function delete($im3_outlet_id) {
        $id_dec = Crypt::decrypt($im3_outlet_id);
        $registered_partner = RegisteredPartner::where('im3_outlet_id', $id_dec)->delete();
        Alert::success('Berhasil', 'Data Berhasil Di Hapus!');
        return back();
    }
}
