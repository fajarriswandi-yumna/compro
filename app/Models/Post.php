<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'posts'; // Opsional

    /**
     * Atribut yang boleh diisi (fillable) untuk mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',     // Foreign key ke tabel categories
        'title',             // Judul postingan
        'slug',              // Slug URL untuk postingan
        'content',           // Konten postingan
        'featured_image_path', // Path ke gambar unggulan (featured image)
        'is_published',      // Status publikasi artikel
    ];

    /**
     * Boot method model.
     *
     * Digunakan untuk menambahkan logic saat model booting (inisialisasi).
     * Dalam kasus ini, untuk membuat slug otomatis dari title saat membuat atau mengupdate Post.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot(); // Panggil boot method dari parent class (Model)

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title); // Buat slug otomatis saat creating (sebelum menyimpan data baru)
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title); // Buat slug otomatis saat updating (sebelum menyimpan perubahan data)
        });
    }
    public function getRouteKeyName()
    {
        return 'id'; // Instruksikan Laravel untuk menggunakan kolom 'slug' sebagai route key
    }


    /**
     * Relasi "Belongs To" dengan model Category.
     *
     * Setiap postingan termasuk ke dalam satu kategori.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); // Satu Post termasuk ke dalam satu Category (many-to-one relationship)
    }
}