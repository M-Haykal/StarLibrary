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
use App\Models\Review;
use App\Models\Favorite;

class ApiController extends Controller
{
    public function pinjam($id)
{
    $buku = Buku::findOrFail($id);
    $siswa = Auth::user();

    if ($buku && $siswa) {
        if ($buku->stok_buku <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Maaf, stok buku sudah habis.'], 400);
        }

        $existingPeminjaman = Peminjaman::where('buku_id', $buku->id)
            ->where('siswa_id', $siswa->id)
            ->where('status', '!=', 'returned')
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'hilang')
            ->where('status', '!=', 'telat')
            ->where('status', '!=', 'rusak')
            ->first();

        if ($existingPeminjaman) {
            return response()->json(['status' => 'error', 'message' => 'Anda sudah meminjam buku ini dan belum mengembalikannya.'], 409);
        }

        $peminjaman = new Peminjaman([
            'buku_id' => $buku->id,
            'judul' => $buku->judul,
            'penerbit' => $buku->penerbit,
            'pengarang' => $buku->pengarang,
            'stok_tersisa' => $buku->stok_buku,
            'thumbnail' => $buku->thumbnail,
            'deskripsi' => $buku->deskripsi,
            'status' => 'waiting',
            'category_id' => $buku->category_id, // Menyimpan category_id dari buku
            'harga' => $buku->harga, // Menyimpan harga dari buku
        ]);

        $siswa->peminjamans()->save($peminjaman);

        return response()->json([
            'status' => 'success',
            'message' => 'Peminjaman berhasil dibuat, menunggu konfirmasi.'
        ]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'ID buku tidak valid atau buku tidak ditemukan.'], 404);
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
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 400);
        }

        $siswa = Siswa::find($request->id);

        if (!$siswa) {
            return response()->json([
                'error' => 'Siswa not found.',
            ], 404);
        }

        $siswa->nama = $request->nama;
        $siswa->email = $request->email;
        $siswa->password = bcrypt($request->password);

        if ($request->hasFile('profile_picture')) {
            if ($siswa->profile_picture) {
                Storage::disk('public')->delete($siswa->profile_picture);
            }

            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $siswa->profile_picture = $profilePicturePath;
        }

        $siswa->save();

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
            'siswa' => $siswa,
        ], 200);
    }

    public function ulasan(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'siswa_id' => 'required|exists:siswas,id'
        ]);
        $review = Review::create([
            'buku_id' => $request->buku_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'siswa_id' => $request->siswa_id
        ]);
        return response()->json(['message' => 'Ulasan diterima', 'review' => $review], 200);
    }
    public function getReviews($id)
{
    try {
        $buku = Buku::findOrFail($id);

        $reviews = $buku->reviews()->with('siswa')->get();

        $formattedReviews = $reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'user_name' => $review->siswa->nama,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'created_at' => $review->created_at,
                'updated_at' => $review->updated_at,
            ];
        });

        return response()->json(['reviews' => $formattedReviews], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Buku tidak ditemukan'], 404);
    }
}

    public function listallfav(Request $request)
    {
        $favorites = Favorite::where('siswa_id', $request->siswa_id)->get();

        $data = $favorites->map(function ($favorite) {
            return [
                'buku_id' => $favorite->buku_id,
                'buku' => $favorite->buku
            ];
        });
        return response()->json(['favorites' => $favorites], 200);
    }

    public function addFavorite(Request $request)
{
    if (Favorite::where('buku_id', $request->buku_id)->where('siswa_id', $request->siswa_id)->exists()) {
        return response()->json(['message' => 'Buku sudah ada di favorit'], 409);
    }

    $request->validate([
        'buku_id' => 'required|exists:bukus,id',
        'siswa_id' => 'required|exists:siswas,id'
    ]);

    $favorite = Favorite::create([
        'buku_id' => $request->buku_id,
        'siswa_id' => $request->siswa_id
    ]);

    return response()->json(['message' => 'Buku ditambahkan ke favorit', 'favorite' => $favorite], 200);
}


    public function removeFavorite(Request $request)
    {
        if (!Favorite::where('buku_id', $request->buku_id)->where('siswa_id', $request->siswa_id)->exists()) {
            return response()->json(['message' => 'Buku tidak ada di favorit'], 404);
        }

        $favorite = Favorite::where('buku_id', $request->buku_id)->where('siswa_id', $request->siswa_id)->first();
        $favorite->delete();
        return response()->json(['message' => 'Buku dihapus dari favorit'], 200);
    }

    public function cancelpeminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'waiting') {
            $peminjaman->status = 'cancelled';
            $peminjaman->save();

            return response()->json(['status' => 'success', 'message' => 'Peminjaman dibatalkan.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid untuk dibatalkan.']);
    }
}
