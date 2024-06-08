<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AuthAPIController extends Controller
{
    public function login(Request $request)
{
    if (Auth::check()) {
        return response()->json([
            'error' => 'You are already logged in.'
        ], Response::HTTP_BAD_REQUEST);
    }

    if ($request->login_as === "Login As") {
        return response()->json([
            'error' => 'Please select login role.'
        ], Response::HTTP_BAD_REQUEST);
    }

    $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required'],
    ]);

    $guard = null;
    if ($request->login_as === "admin") {
        $guard = 'web';
    } elseif ($request->login_as === "costumer") {
        $guard = 'costumer';
    } elseif ($request->login_as === "petugas") {
        $guard = 'petugas';
    }

    if (Auth::guard($guard)->attempt($credentials)) {
        $user = Auth::guard($guard)->user();
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => 'Successfully logged in.',
            'user' => $user,
            'token' => $token
        ])->header('Authorization', 'Bearer ' . $token);
    }

    return response()->json([
        'error' => 'Invalid email or password.'
    ], Response::HTTP_UNAUTHORIZED);
}




    public function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string',
        'kelas' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors()->first(),
        ], Response::HTTP_BAD_REQUEST);
    }

    // Buat user baru sebagai siswa
    $siswa = Siswa::create([
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'email' => $request->email,
        'role_status' => 'siswa',
        'password' => Hash::make($request->password),
    ]);

    // Respon berhasil
    return response()->json([
        'message' => 'Siswa registered successfully.',
        'siswa' => $siswa,
    ], Response::HTTP_CREATED);
}

public function logout(Request $request)
{
    if (Auth::check()) {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out.'
        ]);
    } elseif (Auth::guard('costumer')->check()) {
        Auth::guard('costumer')->logout();
        return response()->json([
            'message' => 'Successfully logged out.'
        ]);
    } else {
        return response()->json([
            'error' => 'You are not logged in.'
        ], Response::HTTP_UNAUTHORIZED);
    }
}


public function resetAllTokens(Request $request)
    {
        // Hapus semua token dari tabel personal_access_tokens
        PersonalAccessToken::truncate();

        return response()->json([
            'message' => 'All tokens have been reset for all users.'
        ], Response::HTTP_OK);
    }


}
