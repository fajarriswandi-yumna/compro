<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Registration; // Import model Registration
use Faker\Factory as Faker; // Import Faker

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Inisialisasi Faker

        // Loop untuk membuat sejumlah data dummy (misalnya 10 data)
        for ($i = 0; $i < 10; $i++) {
            Registration::create([
                'full_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'school_name' => "sekolah ku",
                'payment_package' => 'bulanan',  //
                'payment_status' => "sudah_bayar",
                // Tambahkan kolom lain yang ada di tabel registrations Anda
                // dan gunakan $faker untuk menghasilkan data dummy yang sesuai
            ]);
        }
    }
}