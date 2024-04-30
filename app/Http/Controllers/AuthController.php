<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function borrowing()
    {
        return view('user.borrowing');
    }
    public function favorite()
    {
        return view('user.favorite');
    }
}
