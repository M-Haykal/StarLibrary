<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\BukuOnline;

class ApiController extends Controller
{
    public function pinjam($id)
    {
        $buku = Buku::find($id);
        $siswa = Auth::user();

        if (!$buku) {
            return response()->json(['status' => 'error', 'message' => 'Buku tidak ditemukan.'], Response::HTTP_NOT_FOUND);
        }

        if ($siswa) {
            if ($buku->stok_buku > 0) {
                $existingPeminjaman = Peminjaman::where('buku_id', $buku->id)
                    ->where('siswa_id', $siswa->id)
                    ->first();

                if ($existingPeminjaman) {
                    return response()->json(['status' => 'error', 'message' => 'Anda sudah meminjam buku ini sebelumnya.'], Response::HTTP_CONFLICT);
                }

                $peminjaman = new Peminjaman([
                    'buku_id' => $buku->id,
                    'judul' => $buku->judul,
                    'penerbit' => $buku->penerbit,
                    'pengarang' => $buku->pengarang,
                    'stok_tersisa' => $buku->stok_buku - 1,
                    'thumbnail' => $buku->thumbnail,
                    'status' => 'waiting',
                ]);

                $siswa->peminjamans()->save($peminjaman);

                $buku->stok_buku--;
                $buku->save();

                return response()->json(['status' => 'success', 'message' => 'Buku berhasil dipinjam.'], Response::HTTP_CREATED);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Maaf, buku sedang habis.'], Response::HTTP_CONFLICT);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak memiliki izin untuk melakukan peminjaman.'], Response::HTTP_FORBIDDEN);
        }
    }

    function listPeminjaman()
    {
        $peminjamans = peminjaman::with('category')->get();

        $data = $peminjamans->map(function ($peminjaman) {
            return [
                'id' => $peminjaman->id,
                'buku_id' => $peminjaman->buku_id,
                'judul' => $peminjaman->judul,
                'penerbit' => $peminjaman->penerbit,
                'pengarang' => $peminjaman->pengarang,
                'stok_tersisa' => $peminjaman->stok_tersisa,
                'thumbnail' => $peminjaman->thumbnail,
                'status' => $peminjaman->status,
                'created_at' => $peminjaman->created_at,
                'confirmed_at' => $peminjaman->confirmed_at,
                'returned_at' => $peminjaman->returned_at,
                'category' => $peminjaman->category->name ?? null,
                'siswa_id' => $peminjaman->siswa_id,
                'deskripsi' => $peminjaman->deskripsi,
                'thumbnail' => $peminjaman->thumbnail,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);

    }

    public function destroy(Peminjaman $peminjaman)
    {
        $buku = Buku::where('judul', $peminjaman->judul)->first();

        if (!$buku) {
            return response()->json(['status' => 'error', 'message' => 'Buku tidak ditemukan.'], Response::HTTP_NOT_FOUND);
        }

        $buku->stok_buku++;
        $buku->save();

        $peminjaman->delete();

        return response()->json(['status' => 'success', 'message' => 'Peminjaman berhasil dihapus.'], Response::HTTP_OK);
    }

    public function editProfile(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahan validasi untuk profile_picture
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 400);
        }

        // Temukan siswa berdasarkan ID
        $siswa = Siswa::find($request->id);

        // Jika siswa tidak ditemukan
        if (!$siswa) {
            return response()->json([
                'error' => 'Siswa not found.',
            ], 404);
        }

        // Update profil siswa
        $siswa->nama = $request->nama;
        $siswa->email = $request->email;
        $siswa->password = bcrypt($request->password);

        // Handle profile_picture
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar profil lama jika ada
            if ($siswa->profile_picture) {
                Storage::disk('public')->delete($siswa->profile_picture);
            }

            // Simpan gambar baru
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $siswa->profile_picture = $profilePicturePath;
        }

        // Simpan perubahan
        $siswa->save();

        // Response berhasil
        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
            'siswa' => $siswa,
        ], 200);
    }

}
