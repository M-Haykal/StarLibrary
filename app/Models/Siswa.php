<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    use HasApiTokens;

    protected $guarded = [];

    protected $table = 'siswas';
    public function peminjamans()
{
    return $this->hasMany(Peminjaman::class);
}

    public function favoriteBooks()
    {
        return $this->belongsToMany(Buku::class, 'favorites', 'siswa_id', 'buku_id');
    }
    // Your other model code goes here
}
