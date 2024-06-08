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
        if ($buku->stok_buku <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Maaf, stok buku sudah habis.']);
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
            'harga' => $buku->harga, // Menyimpan harga dari buku
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








    public function downloadPDF(Request $request)
    {
        $month = $request->query('month');

        if ($month) {
            $peminjamans = Peminjaman::whereMonth('created_at', $month)->get();
        } else {
            $peminjamans = Peminjaman::all();
        }

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('pages.pdf', compact('peminjamans')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        $output = $pdf->output();

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="peminjaman.pdf"');
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
        // Ambil jumlah hari dari input form, defaultnya 7 jika tidak ada input
        $jumlahHari = $request->input('jumlah_hari', 7);

        // Tambahkan jumlah hari ke tanggal hari ini sebagai batas pengembalian
        $dueDate = now()->addDays($jumlahHari);
        $peminjaman->due_date = $dueDate;
        $peminjaman->status = 'confirm';
        $peminjaman->save();

        // Update confirmed_at timestamp
        $peminjaman->confirmed_at = now();
        $peminjaman->save();

        return response()->json(['status' => 'success', 'message' => 'Buku berhasil dikonfirmasi.', 'due_date' => $dueDate->format('Y-m-d')]);
    }

    return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid untuk konfirmasi.']);
}


    public function cancel($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'waiting') {
            $peminjaman->status = 'cancelled';
            $peminjaman->save();

            return response()->json(['status' => 'success', 'message' => 'Peminjaman dibatalkan.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid untuk dibatalkan.']);
    }

    public function returnBook(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status == 'confirm') {
        // Ambil status pengembalian buku dari form
        $statusBuku = $request->input('status');

        // Set status pengembalian buku
        $peminjaman->status = $statusBuku;

        // Update returned_at timestamp
        $peminjaman->returned_at = now();

        // Hitung denda berdasarkan status buku
        switch ($statusBuku) {
            case 'returned':
                // Tidak ada denda
                $peminjaman->denda = 0;
                break;
            case 'telat':
                // Hitung jumlah hari telat
                $dueDate = new \DateTime($peminjaman->due_date);
                $returnedDate = new \DateTime();
                $daysLate = $returnedDate->diff($dueDate)->days;
                // Tentukan denda
                $peminjaman->denda = $daysLate * 5000;
                break;
            case 'rusak':
                // Set denda setengah dari harga buku
                $peminjaman->denda = $peminjaman->harga / 2;
                break;
            case 'hilang':
                // Set denda sebesar harga buku
                $peminjaman->denda = $peminjaman->harga;
                break;
            default:
                return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid.']);
        }

        // Simpan perubahan
        $peminjaman->save();

        return response()->json(['status' => 'success', 'message' => 'Buku berhasil dikembalikan.']);
    }

    return response()->json(['status' => 'error', 'message' => 'Status buku tidak valid untuk dikembalikan.']);
}

public function search(Request $request)
{
    $keyword = $request->input('search');

    $peminjamans = Peminjaman::whereHas('siswa', function ($query) use ($keyword) {
        $query->where('nama', 'like', '%' . $keyword . '%');
    })->get();

    return view('your_view_name', compact('peminjamans'));
}

}

