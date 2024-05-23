<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = Siswa::create([
            'nama' => $request->nama,
            'kelas' => 'costumer',
            'email' => $request->email,
            'role_status' => 'siswa',
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // Determine the role based on the email
        $user = User::where('email', $credentials['email'])->first();
        if ($user) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'redirect_url' => route('dashboard_admin')
                ]);
            }
        }

        $siswa = Siswa::where('email', $credentials['email'])->first();
        if ($siswa) {
            if (Auth::guard('costumer')->attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'redirect_url' => route('dashboard_costumer')
                ]);
            }
        }

        $petugas = Petugas::where('email', $credentials['email'])->first();
        if ($petugas) {
            if (Auth::guard('petugas')->attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'redirect_url' => route('dashboard_petugas')
                ]);
            }
        }

        return response()->json([
            'message' => 'Invalid email or password.',
            'redirect_url' => route('login')
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        } elseif (Auth::guard('costumer')->check()) {
            Auth::guard('costumer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }



}
