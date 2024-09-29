<?php

namespace App\Http\Controllers;

use App\Models\DeletedPartner;
use App\Http\Requests\StoreDeletedPartnerRequest;
use App\Http\Requests\UpdateDeletedPartnerRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class DeletedPartnerController extends Controller
{
    public function restore($id) {
        try {
            $id_dec = Crypt::decrypt($id);
            $deletedPartner = DeletedPartner::where('partner_id', $id_dec)->first();

            if ($deletedPartner) {
                DB::table('registered_partners')->insert([
                    'id' => $deletedPartner->partner_id,
                    'im3_outlet_id' => $deletedPartner->im3_outlet_id,
                    'im3_outlet_name' => $deletedPartner->im3_outlet_name,
                    'submission_date' => $deletedPartner->submission_date,
                    'circle' => $deletedPartner->circle,
                    'region' => $deletedPartner->region,
                    'kecamatan' => $deletedPartner->kecamatan,
                    'kabupaten' => $deletedPartner->kabupaten,
                    'longitude' => $deletedPartner->longitude,
                    'latitude' => $deletedPartner->latitude,
                    'qr_code' => $deletedPartner->qr_code,
                    'outlet_name' => $deletedPartner->outlet_name,
                    'created_at' => $deletedPartner->created_at,
                    'updated_at' => $deletedPartner->updated_at,
                ]);

                $deletedPartner->delete();

                Log::info('Partner restored successfully', ['partner_id' => $deletedPartner->partner_id]);
                Alert::toast('Partner has been restored', 'success');
                return redirect()->route('deleted-partner');
            } else {
                Log::warning('Attempted to restore a non-existent partner', ['id' => $id_dec]);
                return redirect()->route('deleted-partner')->with('error', 'Partner not found');
            }
        } catch (\Exception $e) {
            Log::error('Error restoring partner', ['error' => $e->getMessage()]);
            return redirect()->route('deleted-partner')->with('error', 'An error occurred while restoring the partner');
        }
    }

}
