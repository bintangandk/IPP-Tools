<?php

namespace App\Http\Controllers;

use App\Models\DeletedPartner;
use App\Http\Requests\StoreDeletedPartnerRequest;
use App\Http\Requests\UpdateDeletedPartnerRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DeletedPartnerController extends Controller
{
    public function restore($id) {
        $id_dec = Crypt::decrypt($id);
        $deletedPartner = DeletedPartner::find($id_dec);

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

            Alert::toast('Partner has been restored', 'success');
            return redirect()->route('deleted-partner.index');
        } else {
            return redirect()->route('deleted-partner')->with('error', 'Partner not found');
        }
    }

}
