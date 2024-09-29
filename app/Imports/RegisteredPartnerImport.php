<?php

namespace App\Imports;

use App\Models\RegisteredPartner;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegisteredPartnerImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Ubah semua kunci array menjadi huruf kecil
            $row = array_change_key_case($row->toArray(), CASE_LOWER);
            $im3IdUsers = $row['im3_3id_users'] ?? 0; // Ganti 'default_value' sesuai kebutuhan
            $registeredPartner = RegisteredPartner::where('im3_outlet_id', $row['im3_outlet_id'])->first();

            if ($registeredPartner) {
                // Update data jika outlet_id sudah ada
                $registeredPartner->update([
                    'submission_date' => $row['submission_date'],
                    'circle' => $row['circle'],
                    'region' => $row['region'],
                    'kecamatan' => $row['kecamatan'],
                    'kabupaten' => $row['kabupaten'],
                    'kecamatan_unik' => $row['kecamatan_unik'],
                    'longitude' => $row['longitude'],
                    'latitude' => $row['latitude'],
                    'im3_outlet_name' => $row['im3_outlet_name'],
                    '3id_qr_code' => $row['3id_qr_code'],
                    '3id_outlet_name' => $row['3id_outlet_name'],
                    'service' => $row['service'],
                    'branding' => $row['branding'],
                    'post_paid' => $row['post_paid'],
                    'upload_branding' => $row['upload_branding'],
                    'pks' => $row['upload_pks'],
                    'name_owner' => $row['nama_owner'],
                    'nik_owner' => $row['nik_owner'],
                    'npwp_owner' => $row['npwp_owner'],
                    'email_owner' => $row['email_owner'],
                    'im3_3id_users' => $im3IdUsers,
                ]);
            } else {
                // Buat data baru jika outlet_id belum ada
                RegisteredPartner::create([
                    'submission_date' => $row['submission_date'],
                    'circle' => $row['circle'],
                    'region' => $row['region'],
                    'kecamatan' => $row['kecamatan'],
                    'kabupaten' => $row['kabupaten'],
                    'kecamatan_unik' => $row['kecamatan_unik'],
                    'longitude' => $row['longitude'],
                    'latitude' => $row['latitude'],
                    'im3_outlet_id' => $row['im3_outlet_id'],
                    'im3_outlet_name' => $row['im3_outlet_name'],
                    '3id_qr_code' => $row['3id_qr_code'],
                    '3id_outlet_name' => $row['3id_outlet_name'],
                    'service' => $row['service'],
                    'branding' => $row['branding'],
                    'post_paid' => $row['post_paid'],
                    'upload_branding' => $row['upload_branding'],
                    'pks' => $row['upload_pks'],
                    'name_owner' => $row['nama_owner'],
                    'nik_owner' => $row['nik_owner'],
                    'npwp_owner' => $row['npwp_owner'],
                    'email_owner' => $row['email_owner'],
                    'im3_3id_users' => $im3IdUsers,
                ]);
            }
        }
    }
}
