<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Faker Indonesia

        // Ambil beberapa ID client yang sudah ada (pastikan tabel clients sudah di-seed atau ada datanya)
        $clientIds = Client::pluck('id')->toArray();

        if (empty($clientIds)) {
            $this->command->warn("Tidak ada data client. Pastikan ClientsTableSeeder sudah dijalankan terlebih dahulu.");
            return; // Stop seeder jika tidak ada data client
        }

        for ($i = 0; $i < 10; $i++) { // Contoh: buat 10 data tagihan
            $clientId = $faker->randomElement($clientIds); // Pilih random client_id dari yang sudah ada
            $subscribeType = Client::find($clientId)->subscribe_type; // Ambil subscribe_type dari client terkait
            $amount = 0;

            // Logika perhitungan amount berdasarkan subscribe_type (sama seperti di form)
            if ($subscribeType === 'Tahunan') {
                $amount = 50000 * 12;
            } elseif ($subscribeType === 'Bulanan') {
                $amount = 50000;
            }

            Bill::create([
                'no_invoice' => 'INV-' . date('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT), // Contoh format nomor invoice
                'client_id' => $clientId,
                'bill_date' => $faker->date('Y-m-d', 'now'), // Tanggal tagihan random
                'due_date' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'), // Tanggal jatuh tempo random (max 30 hari dari sekarang)
                'payment_status' => $faker->randomElement(['Not Paid', 'Paid']), // Status pembayaran random
                'amount' => $amount, // Jumlah tagihan yang dihitung
            ]);
        }

        $this->command->info('10 data tagihan (bills) berhasil di-seed!'); // Pesan informasi sukses
    }
}