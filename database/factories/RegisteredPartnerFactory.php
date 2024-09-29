<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisteredPartner>
 */
class RegisteredPartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'submission_date' => fake()->date(),
            'circle' => fake()->randomElement([
                'SUMATERA', 'KALIMANTAN', 'JAWA', 'SULAWESI', 'PAPUA',
                'BALI', 'NUSA TENGGARA', 'MALUKU', 'KALIMANTAN UTARA',
                'KALIMANTAN SELATAN', 'KALIMANTAN BARAT', 'SUMATERA SELATAN',
                'SUMATERA BARAT', 'SUMATERA UTARA', 'JAWA TIMUR', 'BANGKA BELITUNG',
                'LAMPUNG', 'BENGKULU', 'GORONTALO', 'SULAWESI TENGGARA', 'SULAWESI TENGAH'
            ]),
            'region' => fake()->randomElement([
                'ACEH', 'SUMATERA UTARA', 'SUMATERA BARAT', 'RIAU', 'JAMBI',
                'SUMATERA SELATAN', 'BENGKULU', 'LAMPUNG', 'KEPULAUAN BANGKA BELITUNG',
                'KEPULAUAN RIAU', 'DKI JAKARTA', 'JAWA BARAT', 'JAWA TENGAH',
                'DI YOGYAKARTA', 'JAWA TIMUR', 'BANTEN', 'BALI', 'NUSA TENGGARA BARAT',
                'NUSA TENGGARA TIMUR', 'KALIMANTAN BARAT', 'KALIMANTAN TENGAH',
                'KALIMANTAN SELATAN', 'KALIMANTAN TIMUR', 'SULAWESI SELATAN',
                'SULAWESI TENGGARA', 'SULAWESI TENGAH', 'SULAWESI UTARA', 'GORONTALO',
                'MALUKU', 'PAPUA BARAT'
            ]),
            'kecamatan' => fake()->randomElement([
                'Banda Raya', 'Medan Timur', 'Tampan', 'Pasar Jambi', 'Ilir Barat',
                'Teluk Segara', 'Tanjung Karang Barat', 'Pangkal Balam', 'Tanjungpinang Barat',
                'Cilacap Selatan', 'Gamping', 'Pasar Minggu', 'Tangerang', 'Denpasar Barat',
                'Mataram', 'Labuhan Bajo', 'Pontianak Utara', 'Pangkalan Bun', 'Banjarmasin Utara',
                'Balikpapan Utara', 'Makassar', 'Kendari', 'Palu Timur', 'Tomohon Selatan',
                'Kota Barat', 'Sorong Timur', 'Jayapura Utara', 'Gunung Sitoli', 'Bukittinggi Timur',
                'Lubuk Pakam'
            ]),
            'kabupaten' => fake()->randomElement([
                'Aceh Besar', 'Deli Serdang', 'Kampar', 'Muaro Jambi', 'Ogan Ilir',
                'Bengkulu Tengah', 'Pesawaran', 'Bangka Selatan', 'Kepulauan Anambas',
                'Cilacap', 'Sleman', 'Jakarta Selatan', 'Tangerang Selatan', 'Badung',
                'Lombok Barat', 'Manggarai Barat', 'Kubu Raya', 'Kotawaringin Barat',
                'Banjar', 'Kutai Kartanegara', 'Gowa', 'Buton', 'Parigi Moutong',
                'Minahasa', 'Bone Bolango', 'Halmahera Tengah', 'Fakfak', 'Nias Selatan',
                'Agam', 'Dairi'
            ]),
            'kecamatan_unik' => fake()->word(),
            'longitude' => fake()->randomFloat(6, 95, 141),
            'latitude' => fake()->randomFloat(6, -11, 6),
            'im3_outlet_id' => fake()->word(),
            'im3_outlet_name' => fake()->word(),
            '3id_qr_code' => fake()->word(),
            '3id_outlet_name' => fake()->word(),
            'service' => fake()->randomElement(['Done', 'Not']),
            'branding' => fake()->randomElement(['Done', 'Not']),
            'post_paid' => fake()->randomElement(['Done', 'Not']),
            'pks' => fake()->word(),
            'upload_branding' => fake()->word(),
            'name_owner' => fake()->name(),
            'nik_owner' => fake()->numerify('################'),
            'npwp_owner' => fake()->numerify('##.###.###.#-###.###'),
            'email_owner' => fake()->safeEmail(),
            'im3_3id_users' => fake()->randomElement([1, 0]),
        ];
    }
}
