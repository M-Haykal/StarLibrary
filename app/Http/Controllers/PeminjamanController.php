<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::all();

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function pinjam($id)
    {
        $buku = Buku::findOrFail($id);
        $siswa = Auth::user();

        if ($buku && $siswa) {
            $existingPeminjaman = Peminjaman::where('buku_id', $buku->id)
                ->where('siswa_id', $siswa->id)
                ->where('status', '!=', 'returned')
                ->first();

            if ($existingPeminjaman) {
                return response()->json(['status' => 'error', 'message' => 'Anda sudah meminjam buku ini dan belum mengembalikannya.']);
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
            ]);

            $siswa->peminjamans()->save($peminjaman);

            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman berhasil dibuat, menunggu konfirmasi.'
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'ID buku tidak valid atau buku tidak ditemukan.']);
        }
    }






    public function downloadPDF()
    {
        $peminjamans = Peminjaman::all();

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('pages.pdf', compact('peminjamans')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();
        file_put_contents('peminjaman.pdf', $output);

        return response()->download('peminjaman.pdf');
    }



    public function destroy(Peminjaman $peminjaman)
    {
        $buku = Buku::where('judul', $peminjaman->judul)->first();

        // Increment the stock of the book when a borrowing record is deleted
        $buku->stok_buku++;
        $buku->save();

        $peminjaman->delete();

        return redirect()->route('profil')->with('success', 'Peminjaman berhasil dihapus.');
    }
    public function confirm(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'waiting') {
            $peminjaman->status = 'confirm';
            $peminjaman->save();

            // Update confirmed_at timestamp
            $peminjaman->confirmed_at = now();
            $peminjaman->save();

            return response()->json(['status' => 'success', 'message' => 'Buku berhasil dikonfirmasi.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid untuk konfirmasi.']);
    }
    public function returnBook($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'confirm') {
            $peminjaman->status = 'returned';
            $peminjaman->save();

            // Update returned_at timestamp
            $peminjaman->returned_at = now();
            $peminjaman->save();

            return response()->json(['status' => 'success', 'message' => 'Buku berhasil dikembalikan.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid untuk dikembalikan.']);
    }
}

