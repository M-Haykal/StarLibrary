<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'bukus';

    protected $fillable = ['judul', 'penerbit', 'pengarang', 'stok_buku', 'thumbnail', 'category_id', 'deskripsi'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}


}
