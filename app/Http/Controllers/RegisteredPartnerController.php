<?php

namespace App\Http\Controllers;

use App\Exports\RegisteredPartnerExport;
use App\Imports\RegisteredPartnerImport;
use App\Models\DeletedPartner;
use App\Models\RegisteredPartner;
use App\Models\Teritory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
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

        // Order data by the most recent first
        $registered_partner->orderBy('created_at', 'desc');

        if (request()->filled('search')) {
            $search = request('search');
            $registered_partner->where(function ($query) use ($search) {
                $query->where('circle', 'LIKE', "%$search%")
                    ->orWhere('region', 'LIKE', "%$search%")
                    ->orWhere('kecamatan', 'LIKE', "%$search%")
                    ->orWhere('kabupaten', 'LIKE', "%$search%")
                    ->orWhere('im3_outlet_name', 'LIKE', "%$search%")
                    ->orWhere('name_owner', 'LIKE', "%$search%");
                // Add other fields to search if necessary
            });
        }

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
        $registered_partner = $registered_partner->paginate(20);
        return view('page.registered-partner.data-partner')->with([
            'title' => 'Data Partner',
            'registered_partner' => $registered_partner,
            'circle' => $circle,
            'region' => $region,
            'area' => $area,
            'sales_area' => $sales_area,
            'search' => request('search')
        ]);
    }

    public function create()
    {
        $circle = Teritory::distinct('circle')->pluck('circle');
        $region = Teritory::distinct('region')->pluck('region');
        $kabupaten = Teritory::distinct('kabupaten')->pluck('kabupaten');
        $kecamatan = Teritory::distinct('kecamatan')->pluck('kecamatan');
        $kecamatan_unik = Teritory::distinct('kecamatan_unik')->pluck('kecamatan_unik');

        return view('page.registered-partner.create-partner')->with([
            'title' => 'Create New Partner',
            'circle' => $circle,
            'region' => $region,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kecamatan_unik' => $kecamatan_unik,

        ]);
    }

    public function createPost(Request $request)
    {
        try {

            // Override 'region' jika role user adalah 'User'
            if (Auth::user()->level == 'User') {
                $request->merge(['region' => Auth::user()->region]);
            }
            // Validate input from form
            $validatedData = $request->validate([
                'submission_date' => 'required|date',
                'circle' => 'required',
                'region' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'kecamatan_unik' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'im3_outlet_id' => 'nullable|string',
                'im3_outlet_name' => 'required',
                '3id_qr_code' => 'nullable|string',
                '3id_outlet_name' => 'required',
                'service' => 'required',
                'branding' => 'required',
                'post_paid' => 'required',
                'name_owner' => 'required',
                'nik_owner' => 'required',
                'npwp_owner' => 'required',
                'email_owner' => 'required|email',
                'status_pks' => 'required',
                'pks' => 'required|file|mimes:pdf,jpeg,jpg,png',
                'upload_branding' => 'required|file|mimes:pdf,jpeg,jpg,png',
            ]);

            // Create instance of RegisteredPartner model
            $registered_partner = new RegisteredPartner();

            $registered_partner->fill($validatedData);

            // Fill all columns with validated data, except for nullable fields
            $registered_partner->fill(array_filter($validatedData, function ($value) {
                return $value !== null;
            }));

            // Handle specific cases
            $registered_partner->im3_outlet_id = $validatedData['im3_outlet_id'] ?? null;
            $registered_partner->{"3id_qr_code"} = $validatedData['3id_qr_code'] ?? null;

            // Set value for im3_3id_users based on conditions
            $registered_partner->im3_3id_users = (!empty($validatedData['im3_outlet_id']) && !empty($validatedData['3id_qr_code'])) ? '1' : '0';

            // Handle PKS file upload
            $pksPath = public_path('pks');
            if (!File::exists($pksPath)) {
                File::makeDirectory($pksPath, 0755, true);
            }

            // Buat nama file berdasarkan ID outlet atau default
            $pksFileName = ($validatedData['im3_outlet_id'] ?? 'default') . '_pks.' . $request->file('pks')->getClientOriginalExtension();

            // Simpan file ke direktori 'pks' di disk 'public'
            $storedPath = $request->file('pks')->storeAs('pks', $pksFileName, 'public');

            // Simpan URL file ke dalam database
            $registered_partner->pks = url('storage/' . $storedPath);
            $registered_partner->save();


            // Handle Branding file upload
            $brandingPath = public_path('branding');
            if (!File::exists($brandingPath)) {
                File::makeDirectory($brandingPath, 0755, true);
            }

            // Buat nama file berdasarkan ID outlet atau default
            $brandingFileName = ($validatedData['im3_outlet_id'] ?? 'default') . '_branding.' . $request->file('upload_branding')->getClientOriginalExtension();

            // Simpan file ke direktori 'branding' di disk 'public'
            $storedPath = $request->file('upload_branding')->storeAs('branding', $brandingFileName, 'public');

            // Simpan URL file ke dalam database
            $registered_partner->upload_branding = url('storage/' . $storedPath);

            // Save data
            $registered_partner->save();


            Alert::success('Success', 'Data successfully saved!');
            return redirect()->route('registered-partner');
        } catch (Exception $error) {
            Log::error($error->getMessage());
            Alert::error('Failed', 'An error occurred, please try again!');
            return back()->withInput();
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

    public function edit($im3_outlet_id)
    {
        $circle = Teritory::distinct('circle')->pluck('circle');
        $region = Teritory::distinct('region')->pluck('region');
        $area = Teritory::distinct('kabupaten')->pluck('kabupaten');
        $sales_area = Teritory::distinct('kecamatan')->pluck('kecamatan');
        $kecamatan_unik = Teritory::distinct('kecamatan_unik')->pluck('kecamatan_unik');

        $id_dec = Crypt::decrypt($im3_outlet_id);
        $registered_partner = RegisteredPartner::where('im3_outlet_id', $id_dec)->first();
        return view('page.registered-partner.edit-partner')->with([
            'title' => 'Edit Partner',
            'partner' => $registered_partner,
            'id_dec' => $id_dec,
            'circle' => $circle,
            'region' => $region,
            'area' => $area,
            'sales_area' => $sales_area,
            'kecamatan_unik' => $kecamatan_unik,
        ]);
    }

    public function editPost(Request $request, $im3_outlet_id)
    {
        try {
            // Validate input from form
            $validatedData = $request->validate([
                'submission_date' => 'required|date',
                'circle' => 'required',
                'region' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'kecamatan_unik' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'im3_outlet_id' => 'required|string',
                'im3_outlet_name' => 'required',
                '3id_qr_code' => 'nullable|string',
                '3id_outlet_name' => 'required',
                'service' => 'required',
                'branding' => 'required',
                'post_paid' => 'required',
                'name_owner' => 'required',
                'nik_owner' => 'required',
                'npwp_owner' => 'required',
                'email_owner' => 'required|email',
                'status_pks' => 'required',
                'pks' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
                'upload_branding' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
            ]);

            $registered_partner = RegisteredPartner::where('im3_outlet_id', $im3_outlet_id)->firstOrFail();

            // Update fields
            $registered_partner->fill($validatedData);
            if ($request->hasFile('pks')) {
                $pksPath = 'pks';
                $pksFileName = $im3_outlet_id . '_pks.' . $request->file('pks')->getClientOriginalExtension();
                $path = $request->file('pks')->storeAs($pksPath, $pksFileName, 'public');

                // Buat URL secara manual
                $url = url('storage/' . $path); // Sesuaikan dengan struktur URL Anda

                // Simpan URL ke database
                $registered_partner->pks = $url;
                $registered_partner->save(); // Simpan data ke database
            }

            // Handle Branding file upload
            if ($request->hasFile('upload_branding')) {
                $brandingPath = 'branding'; // Path di dalam storage
                $brandingFileName = $im3_outlet_id . '_branding.' . $request->file('upload_branding')->getClientOriginalExtension();

                // Simpan file dan dapatkan path
                $path = $request->file('upload_branding')->storeAs($brandingPath, $brandingFileName, 'public');

                // Buat URL secara manual
                $url = url('storage/' . $path); // Sesuaikan dengan struktur URL Anda

                // Simpan URL ke database
                $registered_partner->upload_branding = $url;
                $registered_partner->save(); // Simpan data ke database
            }

            // Set value for im3_3id_users based on conditions
            $registered_partner->im3_3id_users = (!empty($validatedData['im3_outlet_id']) && !empty($validatedData['3id_qr_code'])) ? '1' : '0';

            // Save data
            $registered_partner->save();

            Alert::success('Success', 'Data successfully updated!');
            return redirect()->route('registered-partner');
        } catch (Exception $error) {
            Log::error($error->getMessage());
            Alert::error('Failed', 'An error occurred, please try again!');
            return back()->withInput();
        }
    }

    public function delete($im3_outlet_id)
    {
        $id_dec = Crypt::decrypt($im3_outlet_id);
        $registered_partner = RegisteredPartner::where('im3_outlet_id', $id_dec)->first();

        if ($registered_partner) {
            Log::info('Menyimpan data deleted partner:', [
                'partner_id' => $registered_partner->id,
                'alasan' => request()->input('reason'),
                'submission_date' => $registered_partner->submission_date,
                'circle' => $registered_partner->circle,
                'region' => $registered_partner->region,
                'kecamatan' => $registered_partner->kecamatan,
                'kabupaten' => $registered_partner->kabupaten,
                'kecamatan_unik' => $registered_partner->kecamatan_unik,
                'longitude' => $registered_partner->longitude,
                'latitude' => $registered_partner->latitude,
                'im3_outlet_id' => $registered_partner->im3_outlet_id,
                'im3_outlet_name' => $registered_partner->im3_outlet_name,
                '3id_qr_code' => $registered_partner->{"3id_qr_code"},
                '3id_outlet_name' => $registered_partner->{"3id_outlet_name"},
                'service' => $registered_partner->service,
                'branding' => $registered_partner->branding,
                'status_pks' => $registered_partner->status_pks,
                'post_paid' => $registered_partner->post_paid,
                'pks' => $registered_partner->pks,
                'upload_branding' => $registered_partner->upload_branding,
                'name_owner' => $registered_partner->name_owner,
                'nik_owner' => $registered_partner->nik_owner,
                'npwp_owner' => $registered_partner->npwp_owner,
                'email_owner' => $registered_partner->email_owner,
                'im3_3id_users' => $registered_partner->im3_3id_users,
            ]);
            // Buat entry baru di DeletedPartner
            DeletedPartner::create([
                'partner_id' => $registered_partner->id,
                'alasan' => request()->input('reason'), // Ambil alasan dari request
                'submission_date' => $registered_partner->submission_date,
                'circle' => $registered_partner->circle,
                'region' => $registered_partner->region,
                'kecamatan' => $registered_partner->kecamatan,
                'kabupaten' => $registered_partner->kabupaten,
                'kecamatan_unik' => $registered_partner->kecamatan_unik, // Tambahkan ini
                'longitude' => $registered_partner->longitude,
                'latitude' => $registered_partner->latitude,
                'im3_outlet_id' => $registered_partner->im3_outlet_id ? $registered_partner->im3_outlet_id : null, // Sesuaikan nama field
                'im3_outlet_name' => $registered_partner->im3_outlet_name,
                '3id_qr_code' => $registered_partner->{"3id_qr_code"} ? $registered_partner->{"3id_qr_code"} : null, // Sesuaikan nama field
                '3id_outlet_name' => $registered_partner->{"3id_outlet_name"}, // Sesuaikan nama field
                'service' => $registered_partner->service, // Tambahkan ini
                'branding' => $registered_partner->branding, // Tambahkan ini
                'status_pks' => $registered_partner->status_pks,
                'post_paid' => $registered_partner->post_paid, // Tambahkan ini
                'pks' => $registered_partner->pks,
                'upload_branding' => $registered_partner->upload_branding,
                'name_owner' => $registered_partner->name_owner,
                'nik_owner' => $registered_partner->nik_owner,
                'npwp_owner' => $registered_partner->npwp_owner,
                'email_owner' => $registered_partner->email_owner,
                'im3_3id_users' => $registered_partner->im3_3id_users, // Tambahkan ini
                'created_at' => $registered_partner->created_at,
                'updated_at' => $registered_partner->updated_at
            ]);

            // Hapus data dari RegisteredPartner
            $registered_partner->delete();

            Alert::success('Berhasil', 'Data Berhasil Di Hapus!');
        } else {
            Alert::error('Gagal', 'Data tidak ditemukan!');
        }

        return back();
    }
}
