<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Petugas;
use App\Models\BukuOnline;
use App\Models\Category;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index_admin () {
        $bukus = Buku::all();
        $siswas = Siswa::all();
        return view('index_admin', compact("bukus", "siswas"));
    }

    public function petugas_manager()
    {
        $petugas = Petugas::all();
        return view('admin.petugas_manager', compact('petugas'));
    }


    public function panelBukuAdmin()
{
    $bukus = Buku::all();
    $categories = Category::all();


    return view('admin.panel_buku_admin', compact("bukus", "categories"));
}
    public function panelBukuPetugas()
{
    $bukus = Buku::all();
    $categories = Category::all();


    return view('panel_buku_petugas', compact("bukus", "categories"));
}
public function panelPeminjamanPetugas()
{
    $bukus = Buku::all();
    $peminjamans = Peminjaman::all();

    return view('petugas.daftarpeminjaman', compact("bukus", "peminjamans"));
}
public function panelKategoriPetugas()
{
    $bukus = Buku::all();
    $categories = Category::all();
    $peminjamans = Peminjaman::all();

    return view('petugas.kategori', compact("bukus", "peminjamans", "categories"));
}

    public function index_siswa () {
        $bukus = Buku::all();
        $categories = Category::all();
        return view('index_siswa', compact('bukus'));
    }
    public function index_petugas () {
        $bukus = Buku::all();
        $jumlahBuku = Buku::count();
        $jumlahKategori = Category::count();
        $jumlahPeminjaman = Peminjaman::count();
        $bukuOnlines = BukuOnline::count();
        return view('index_petugas', compact('bukus','jumlahBuku', 'jumlahKategori', 'jumlahPeminjaman', 'bukuOnlines'));
    }

    public function login () {
        return view('login');
    }

    public function register () {
        return view('register');
    }

    public function profil () {
        $bukus = Buku::all();
        $siswas = Siswa::all();
        $peminjamans = Peminjaman::all();
        return view('profil', compact("bukus", "siswas", "peminjamans"));
    }
    public function editProfile(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $siswa = Siswa::findOrFail($id);

    // Cek apakah ada gambar yang diunggah
    if ($request->hasFile('profile_picture')) {
        // Hapus gambar profil lama jika ada
        if ($siswa->profile_picture) {
            Storage::disk('public')->delete($siswa->profile_picture);
        }

        // Simpan gambar baru
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $siswa->profile_picture = $profilePicturePath;
    }

    $siswa->update([
        'nama' => $validatedData['nama'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
    ]);

    return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui');
}


    public function landing () {
        $bukus = Buku::with('reviews')->get();
        $peminjamans = Peminjaman::all();
        foreach ($bukus as $buku) {
            $totalRating = Review::where('buku_id', $buku->id)->avg('rating');
            $buku->totalRating = round($totalRating, 1); // Round rating ke satu desimal
        }
        return view('welcome', compact('bukus', 'peminjamans'));
    }
    public function online() {
        $bukus = Buku::all(); // Ambil semua buku
        $bukuOnlines = BukuOnline::all(); // Ambil semua buku online
        $categories = Category::all(); // Ambil semua kategori
        return view('costumer.online', compact('bukus', 'bukuOnlines', 'categories'));
    }

    public function addToFavorite(Request $request)
    {
        try {
            $siswaId = Auth::id();
            $bukuId = $request->buku_id;

            // Periksa apakah buku sudah ada di favorit
            if (Favorite::where('siswa_id', $siswaId)->where('buku_id', $bukuId)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'Buku sudah ada di favorit']);
            }

            Favorite::create([
                'siswa_id' => $siswaId,
                'buku_id' => $bukuId,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Buku berhasil ditambahkan ke favorit']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage(), 'error' => $e->getMessage()]);
        }
    }

    public function removeFavorite($buku_id)
    {
        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($buku_id);

        // Dapatkan siswa yang sedang login
        $siswa = auth()->user();

        // Hapus buku dari daftar favorit siswa
        $siswa->favoriteBooks()->detach($buku);

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari daftar favorit.');
    }


    public function ulasan(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'peminjaman_id' => 'required|exists:peminjamans,id'
        ]);

        $peminjaman = Peminjaman::find($request->peminjaman_id);

        // Cek apakah status peminjaman sudah dikonfirmasi
        if ($peminjaman->status !== 'returned') {
            return response()->json(['status' => 'error', 'message' => 'Kamu Hanya bisa Mengirim Ulasan jika Peminjaman Sudah di kembalikan.']);
        }

        // Cek apakah sudah ada ulasan untuk peminjaman ini
        $existingReview = Review::where('peminjaman_id', $request->peminjaman_id)->first();
        if ($existingReview) {
            return response()->json(['status' => 'error', 'message' => 'Kamu Sudah Mengirim Ulasan.']);
        }

        // Buat ulasan baru
        $review = Review::create([
            'siswa_id' => auth()->user()->id,
            'buku_id' => $request->buku_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'peminjaman_id' => $request->peminjaman_id
        ]);

        return response()->json(['status' => 'success', 'message' => 'Review berhasil Di kirim.', 'buku_id' => $request->buku_id]);
    }

    public function getReviews($id)
{
    // Cari buku berdasarkan ID
    $buku = Buku::findOrFail($id);

    // Ambil ulasan buku beserta nama pengguna
    $reviews = $buku->reviews()->with('siswa')->get();

    // Format data ulasan untuk mengambil nama pengguna
    $formattedReviews = $reviews->map(function ($review) {
        return [
            'id' => $review->id,
            'user_name' => $review->siswa->nama, // Mengambil nama pengguna dari relasi siswa
            'rating' => $review->rating, // Mengambil nama pengguna dari relasi siswa
            'comment' => $review->comment,
            'created_at' => $review->created_at,
            'updated_at' => $review->updated_at,
        ];
    });

    // Kembalikan ulasan dalam bentuk JSON
    return response()->json(['reviews' => $formattedReviews]);
}

    public function fetchBookDetails($id)
    {
        $book = Buku::findOrFail($id);
        return response()->json(['book' => $book]);
    }


    public function delete_buku($id) {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('panel_buku_admin')->with('success', 'Buku berhasil dihapus');
    }
    public function delete_buku_petugas($id) {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('panel_buku_petugas')->with('success', 'Buku berhasil dihapus');
    }

    public function create_buku(Request $request) {

    $validatedData = $request->validate([
        'judul' => 'required|string',
        'penerbit' => 'required|string',
        'pengarang' => 'required|string',
        'stok_buku' => 'required|integer',
        'category_id' => 'required|exists:categories,id', // Validation for category_id, ensuring it exists in the categories table
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image file
        'deskripsi' => 'nullable|string'  // Validate description
    ]);

    // Check if thumbnail is uploaded
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public'); // Store the thumbnail
        $validatedData['thumbnail'] = $thumbnailPath; // Save the path in validated data
    }

    Buku::create($validatedData); // Create the book with validated data

        return redirect()->route('panel_buku_admin')->with('success', 'Buku berhasil ditambahkan');
    }
    public function create_buku_petugas(Request $request)
{
    $validatedData = $request->validate([
        'judul' => 'required|string',
        'penerbit' => 'required|string',
        'pengarang' => 'required|string',
        'stok_buku' => 'required|integer',
        'category_id' => 'required|exists:categories,id', // Validation for category_id, ensuring it exists in the categories table
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image file
        'deskripsi' => 'nullable|string'  // Validate description
    ]);

    // Check if thumbnail is uploaded
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public'); // Store the thumbnail
        $validatedData['thumbnail'] = $thumbnailPath; // Save the path in validated data
    }

    Buku::create($validatedData); // Create the book with validated data

    return redirect()->route('panel_buku_petugas')->with('success', 'Buku berhasil ditambahkan');
}



    public function edit_buku(Request $request, $id) {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'penerbit' => 'required|string',
            'pengarang' => 'required|string',
            'stok_buku' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Validasi untuk category_id
            'deskripsi' => 'nullable|string'  // Validate description
        ]);

        $buku = Buku::findOrFail($id);

        // Update data buku
        $buku->update([
            'judul' => $validatedData['judul'],
            'penerbit' => $validatedData['penerbit'],
            'pengarang' => $validatedData['pengarang'],
            'stok_buku' => $validatedData['stok_buku'],
            'category_id' => $validatedData['category_id'], // Memperbarui category_id
            'deskripsi' => $validatedData['deskripsi'],  // Validate description
        ]);
        return redirect()->route('panel_buku_admin')->with('success', 'Buku berhasil diedit');
    }
    public function edit_buku_petugas(Request $request, $id) {
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'penerbit' => 'required|string',
            'pengarang' => 'required|string',
            'stok_buku' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Validasi untuk category_id
            'deskripsi' => 'nullable|string'  // Validate description
        ]);

        $buku = Buku::findOrFail($id);

        // Update data buku
        $buku->update([
            'judul' => $validatedData['judul'],
            'penerbit' => $validatedData['penerbit'],
            'pengarang' => $validatedData['pengarang'],
            'stok_buku' => $validatedData['stok_buku'],
            'category_id' => $validatedData['category_id'], // Memperbarui category_id
            'deskripsi' => $validatedData['deskripsi'],  // Validate description
        ]);

        return redirect()->route('panel_buku_petugas')->with('success', 'Buku berhasil diedit');
    }

    public function store_siswa(Request $request)
    {
        // $datas = $request->validate([
        //     'nama' => 'required|string',
        //     'kelas' => 'required|string',
        //     'email' => 'required|email|unique:siswa',
        //     'password' => 'required|min:6',
        // ]);
        Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_status' => 'siswa',
        ]);


        return redirect()->route('dashboard_admin')->with('success', 'Siswa created successfully.');
    }

    public function edit_siswa(Request $request, $id)
    {
        // $datas = $request->validate([
        //     'nama' => 'required|string',
        //     'kelas' => 'required|string',
        //     'email' => 'required|email|unique:siswa',
        //     'password' => 'required|min:6',
        // ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_status' => 'siswa',
        ]);

        return redirect()->route('dashboard_admin')->with('success', 'Siswa updated successfully');
    }

    public function delete_siswa($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return redirect()->route('dashboard_admin')->with('success', 'Siswa deleted successfully');
    }

        public function store_petugas(Request $request)
    {
        Petugas::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_status' => 'petugas',
        ]);

        return redirect()->route('petugas_manager')->with('success', 'Petugas created successfully.');
    }

    public function edit_petugas(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $petugas->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_status' => 'petugas',
        ]);

        return redirect()->route('petugas_manager')->with('success', 'Petugas updated successfully');
    }

    public function delete_petugas($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas_manager')->with('success', 'Petugas deleted successfully');
    }

    public function showDataPeminjaman()
    {
        $peminjamans = Peminjaman::all();
        return view('data_peminjaman', compact('peminjamans'));
    }

}
