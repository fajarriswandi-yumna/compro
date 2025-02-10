<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'categories'; // Opsional, jika nama tabel sesuai konvensi Laravel (plural dari nama model), bisa dihilangkan

    /**
     * Atribut yang boleh diisi (fillable) untuk mass assignment.
     *
     * Atribut-atribut ini dapat diisi secara massal menggunakan metode seperti `create` dan `fill`.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Field 'name' boleh diisi
    ];

    /**
     * Relasi "Has Many" dengan model Post.
     *
     * Kategori ini dapat memiliki banyak postingan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class); // Satu Category memiliki banyak Post (one-to-many relationship)
    }
}