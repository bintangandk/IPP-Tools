<?php
namespace App\Imports;

use App\Models\RegisteredPartner;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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

             // Memeriksa dan mengganti nilai longitude dan latitude dengan null jika kosong
        $longitude = !empty($row['longitude']) ? $row['longitude'] : null;
        $latitude = !empty($row['latitude']) ? $row['latitude'] : null;

            // Konversi submission_date dari serial number ke format tanggal d/m/Y
            $submissionDate = $this->transformDate($row['submission_date']);

            $registeredPartner = RegisteredPartner::where('im3_outlet_id', $row['im3_outlet_id'])->first();

         
                // Buat data baru jika outlet_id belum ada
                RegisteredPartner::create([
                    'submission_date' => $submissionDate, // Tanggal yang sudah dikonversi
                    'circle' => $row['circle'],
                    'region' => $row['region'],
                    'kecamatan' => $row['kecamatan'],
                    'kabupaten' => $row['kabupaten'],
                    'kecamatan_unik' => $row['kecamatan_unik'],
                    'longitude' => $longitude,
                    'latitude' => $latitude,
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

    private function transformDate($value)
    {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        // Kembalikan nilai asli jika sudah berupa string tanggal
        return $value;
    }
}
