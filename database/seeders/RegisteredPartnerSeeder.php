<?php

namespace Database\Seeders;

use App\Models\RegisteredPartner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegisteredPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegisteredPartner::factory(100)->create();
    }
}
