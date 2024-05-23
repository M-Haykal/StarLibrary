<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'buku_id', 'comment', 'rating']; // Menambahkan 'rating'

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
