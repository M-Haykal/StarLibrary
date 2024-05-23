<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'buku_id',
        'judul',
        'penerbit',
        'pengarang',
        'stok_tersisa',
        'thumbnail',
        'status',
        'category_id', // Menyimpan category_id dari buku
        'deskripsi',
        'confirmed_at', // New field
        'returned_at'   // New field
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
