<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuOnline extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penerbit',
        'pengarang',
        'stok_buku',
        'category_id',
        'thumbnail',
        'pdf_file',
        'deskripsi',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
