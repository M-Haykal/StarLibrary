<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function favorite()
    {
        return view('user.favorite');
    }
    public function online()
    {
        return view('buku.online');
    }
    public function offline()
    {
        return view('buku.offline');
    }

    public function registration()
    {
        return view('registrasi');
    }
}
