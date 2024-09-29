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
                // Simpan data ke tabel registered_partners
                DB::table('registered_partners')->insert([
                    'id' => $deletedPartner->partner_id,
                    'submission_date' => $deletedPartner->submission_date,
                    'circle' => $deletedPartner->circle,
                    'region' => $deletedPartner->region,
                    'kecamatan' => $deletedPartner->kecamatan,
                    'kabupaten' => $deletedPartner->kabupaten,
                    'kecamatan_unik' => $deletedPartner->kecamatan_unik, // Tambahkan kolom kecamatan_unik
                    'longitude' => $deletedPartner->longitude,
                    'latitude' => $deletedPartner->latitude,
                    'im3_outlet_id' => $deletedPartner->im3_outlet_id,
                    'im3_outlet_name' => $deletedPartner->im3_outlet_name,
                    '3id_qr_code' => $deletedPartner->{"3id_qr_code"}, // Tambahkan kolom 3id_qr_code
                    '3id_outlet_name' => $deletedPartner->{"3id_outlet_name"}, // Tambahkan kolom 3id_outlet_name
                    'service' => $deletedPartner->service,
                    'branding' => $deletedPartner->branding,
                    'post_paid' => $deletedPartner->post_paid,
                    'pks' => $deletedPartner->pks,
                    'upload_branding' => $deletedPartner->upload_branding,
                    'name_owner' => $deletedPartner->name_owner,
                    'nik_owner' => $deletedPartner->nik_owner,
                    'npwp_owner' => $deletedPartner->npwp_owner,
                    'email_owner' => $deletedPartner->email_owner,
                    'im3_3id_users' => $deletedPartner->im3_3id_users,
                    'created_at' => now(), // Atur created_at menjadi waktu saat ini
                    'updated_at' => now(), // Atur updated_at menjadi waktu saat ini
                ]);

                // Hapus data dari deleted_partners setelah berhasil di-restore
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
