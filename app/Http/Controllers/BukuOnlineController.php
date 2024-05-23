<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuOnline;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class BukuOnlineController extends Controller
{
    public function create_buku_online(Request $request)
{
    try {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'penerbit' => 'required|string',
            'pengarang' => 'required|string',
            'stok_buku' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'required|mimes:pdf',
            'deskripsi' => 'nullable|string'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        if ($request->hasFile('pdf_file')) {
            $pdfFilePath = $request->file('pdf_file')->store('pdf_files', 'public');
            $validatedData['pdf_file'] = $pdfFilePath;
        }

        BukuOnline::create($validatedData);

        return response()->json(['status' => 'success', 'message' => 'Buku berhasil ditambahkan']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['status' => 'error', 'message' => $e->validator->errors()->first()]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan. Silakan coba lagi.']);
    }
}


    public function edit_buku_online(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'penerbit' => 'required|string',
            'pengarang' => 'required|string',
            'stok_buku' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'deskripsi' => 'nullable|string'
        ]);

        $buku = BukuOnline::findOrFail($id);

        // Simpan thumbnail jika diunggah
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        // Simpan file PDF jika diunggah
        if ($request->hasFile('pdf_file')) {
            $pdfFilePath = $request->file('pdf_file')->store('pdf_files', 'public');
            $validatedData['pdf_file'] = $pdfFilePath;

            // Hapus file PDF lama dari sistem file
            Storage::disk('public')->delete($buku->pdf_file);
        }

        $buku->update($validatedData);

        return redirect()->route('panel_buku_online')->with('success', 'Buku berhasil diedit');
    }

    public function delete_buku_online($id)
    {
        $buku = BukuOnline::findOrFail($id);

        // Hapus file thumbnail dan PDF dari sistem file
        Storage::disk('public')->delete([$buku->thumbnail, $buku->pdf_file]);

        $buku->delete();

        return redirect()->route('panel_buku_online')->with('success', 'Buku berhasil dihapus');
    }
    public function panelBukuOnline()
    {
        $bukus = Buku::all(); // Ambil semua buku
        $bukuOnlines = BukuOnline::all(); // Ambil semua buku online
        $categories = Category::all(); // Ambil semua kategori

        return view('petugas.bukuonline', compact('bukus', 'bukuOnlines', 'categories')); // Kirim data ke view
    }
}
