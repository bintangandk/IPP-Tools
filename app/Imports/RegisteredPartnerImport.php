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
            // Cek apakah RegisteredPartner dengan im3_outlet_id yang sama sudah ada
            $registeredPartner = RegisteredPartner::where('im3_outlet_id', $row['im3_outlet_id'])->first();
            if ($registeredPartner) {
                // Jika ada, perbarui data
                $registeredPartner->update([
                    'submission_date' => $row['submission_date'],
                    'circle' => $row['circle'],
                    'region' => $row['region'],
                    'kecamatan' => $row['kecamatan'],
                    'kabupaten' => $row['kabupaten'],
                    'longitude' => $row['longitude'],
                    'latitude' => $row['latitude'],
                    'qr_code' => $row['qr_code'],
                    'outlet_name' => $row['outlet_name'],
                ]);
            } else {
                // Jika tidak ada, buat entri baru
                RegisteredPartner::create([
                    'submission_date' => $row['submission_date'],
                    'circle' => $row['circle'],
                    'region' => $row['region'],
                    'kecamatan' => $row['kecamatan'],
                    'kabupaten' => $row['kabupaten'],
                    'longitude' => $row['longitude'],
                    'latitude' => $row['latitude'],
                    'im3_outlet_id' => $row['im3_outlet_id'],
                    'im3_outlet_name' => $row['im3_outlet_name'],
                    'qr_code' => $row['qr_code'],
                    'outlet_name' => $row['outlet_name'],
                ]);
            }
        }
    }
}
