<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit()
    {
        $siswa = Siswa::find(auth()->id());
        return view('edit-profile', compact('siswas'));
    }

    public function update(Request $request)
    {
        $siswas = Siswa::find(auth()->id());
        $siswas->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
