<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kategori yang sudah ada di database.
        // Kita asumsikan CategoriesTableSeeder sudah dijalankan terlebih dahulu
        // dan sudah membuat beberapa kategori.
        $categories = Category::all();

        // Pastikan ada minimal 5 kategori sebelum membuat postingan.
        // Ini untuk menghindari error jika categories seeder belum dijalankan atau gagal.
        if ($categories->count() >= 5) {
            // Membuat 5 contoh postingan blog.
            // Setiap postingan akan dikaitkan dengan kategori yang berbeda.

            Post::create([
                'category_id' => $categories[0]->id, // Kategori pertama (index 0) yang diambil dari collection $categories
                'title' => 'Masa Depan Kecerdasan Buatan',
                'slug' => 'masa-depan-kecerdasan-buatan', // Slug sudah otomatis dibuat di Model Post, ini contoh jika manual
                'content' => 'Kecerdasan buatan (AI) terus berkembang pesat dan mengubah berbagai aspek kehidupan kita. Artikel ini membahas tren terbaru dan potensi AI di masa depan...',
                // 'featured_image_path' => null, // Anda bisa menambahkan path gambar jika ada, contoh: 'post_images/gambar-ai.jpg'
            ]);

            Post::create([
                'category_id' => $categories[1]->id, // Kategori kedua (index 1)
                'title' => 'Strategi Pemasaran Digital Efektif di Tahun 2024',
                'slug' => 'strategi-pemasaran-digital-efektif-di-tahun-2024', // Slug sudah otomatis dibuat di Model Post
                'content' => 'Pemasaran digital adalah kunci sukses bisnis di era modern. Pelajari strategi pemasaran digital terbaru yang akan membantu bisnis Anda berkembang di tahun 2024...',
                // 'featured_image_path' => null,
            ]);

            Post::create([
                'category_id' => $categories[2]->id, // Kategori ketiga (index 2)
                'title' => 'Rahasia Branding Kuat untuk Bisnis Anda',
                'slug' => 'rahasia-branding-kuat-untuk-bisnis-anda', // Slug sudah otomatis dibuat di Model Post
                'content' => 'Branding yang kuat adalah aset berharga bagi setiap bisnis. Temukan rahasia membangun branding yang efektif dan membedakan bisnis Anda dari kompetitor...',
                // 'featured_image_path' => null,
            ]);

            Post::create([
                'category_id' => $categories[3]->id, // Kategori keempat (index 3)
                'title' => 'Tren Desain Web yang Akan Mendominasi Tahun Depan',
                'slug' => 'tren-desain-web-yang-akan-mendominasi-tahun-depan', // Slug sudah otomatis dibuat di Model Post
                'content' => 'Desain web terus berevolusi. Ikuti tren desain web terbaru yang akan populer di tahun mendatang untuk memastikan website Anda tetap modern dan menarik...',
                // 'featured_image_path' => null,
            ]);

            Post::create([
                'category_id' => $categories[4]->id, // Kategori kelima (index 4)
                'title' => 'Tips Meningkatkan Produktivitas Kerja dari Rumah',
                'slug' => 'tips-meningkatkan-produktivitas-kerja-dari-rumah', // Slug sudah otomatis dibuat di Model Post
                'content' => 'Kerja dari rumah menjadi semakin umum. Dapatkan tips praktis untuk meningkatkan produktivitas dan menjaga keseimbangan kerja-hidup saat bekerja dari rumah...',
                // 'featured_image_path' => null,
            ]);
        } else {
            // Menampilkan pesan peringatan jika kategori kurang dari 5.
            // Ini penting untuk memberikan informasi jika seeder categories belum dijalankan.
            $this->command->warn("Peringatan: Kurang dari 5 kategori ditemukan. Pastikan CategoriesTableSeeder dijalankan terlebih dahulu.");
        }
    }
}