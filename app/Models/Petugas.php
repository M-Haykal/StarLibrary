<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $guarded = [];

    protected $table = 'petugas';
}
