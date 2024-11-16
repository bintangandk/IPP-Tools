<?php

namespace App\Imports;

use App\Models\NamaModel;
use App\Models\Teritory;
use Maatwebsite\Excel\Concerns\ToModel;

class DataSeederImport implements ToModel
{
    public function model(array $row)
    {
        return new Teritory([
            'circle' => $row[0],
            'region' => $row[1],
            'area' => $row[2],
            'sales_area' => $row[3],
            'cluster' => $row[4],
            'micro_cluster' => $row[5],
            'partner_teritory' => $row[6],
            'partner' => $row[7],
            'type' => $row[8],
            'kecamatan_unik' => $row[9],
            'kecamatan' => $row[10],
            'kabupaten' => $row[11],
            'mc_type' => $row[12],
            'flag_prog' => $row[13],
            'flag' => $row[14],
        ]);
    }
}
