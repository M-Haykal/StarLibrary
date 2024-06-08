<?php

namespace App\Http\Controllers;

use App\Models\BukuOnline;
use Illuminate\Http\Request;
use App\Models\Buku;


class BookController extends Controller
{
    public function listBuku(Request $request)
    {
        // Periksa keberadaan Bearer Token di header Authorization
        if (!$request->bearerToken()) {
            return response()->json(['error' => 'You are not logged in.'], 401);
        }

        // Ambil daftar buku dari database
        $bukus = Buku::all();

        // Kembalikan respons dengan daftar buku
        return response()->json(['bukus' => $bukus]);
    }

    public function listBukuOnline()
    {
        // Ambil semua buku online
        $bukuOnlines = BukuOnline::with('category')->get();

        // Format data untuk API response
        $data = $bukuOnlines->map(function ($buku) {
            return [
                'id' => $buku->id,
                'judul' => $buku->judul,
                'penerbit' => $buku->penerbit,
                'pengarang' => $buku->pengarang,
                'stok_buku' => $buku->stok_buku,
                'category' => $buku->category->name ?? null, // Pastikan kategori ada
                'deskripsi' => $buku->deskripsi,
                'thumbnail' => $buku->thumbnail,
                'pdf_file' => $buku->pdf_file,
            ];
        });

        // Kembalikan response JSON
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

}
