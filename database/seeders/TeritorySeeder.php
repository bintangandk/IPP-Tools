<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataSeederImport;

class TeritorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Excel::import(new DataSeederImport, public_path('excel/teritory.xlsx'));
    }
}
