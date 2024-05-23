<?php

// app/Models/Transaksi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'buku_id'];

    // Define relationship with Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Define relationship with Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}

