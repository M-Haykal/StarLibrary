<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship with Buku
    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }

    // Relationship with Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function bukuOnlines()
    {
        return $this->hasMany(BukuOnline::class);
    }
}
