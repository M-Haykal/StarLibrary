<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BukuOnlineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfAuthenticated;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LibraryController::class, 'login'])->name('login')->middleware(RedirectIfAuthenticated::class);
Route::get('/register', [LibraryController::class, 'register'])->name('register')->middleware(RedirectIfAuthenticated::class);


// Login Action
Route::post('/login', [AuthController::class, 'login'])->name('login_user');

// register action
Route::post('/register', [AuthController::class, 'register'])->name('register_user');

// logout action
Route::post('/logout', [AuthController::class, 'logout'])->name('logout_user');

Route::prefix('admin')->middleware('auth')->group(function (){
    Route::get('/dashboard', [LibraryController::class, 'index_admin'])->name('dashboard_admin');
    Route::get('/buku', [LibraryController::class, 'panelBukuAdmin'])->name('panel_buku_admin');

    Route::delete('/buku/{id}', [LibraryController::class, 'delete_buku'])->name('buku.delete');
    Route::post('/buku', [LibraryController::class, 'create_buku'])->name('buku.create');
    Route::put('/buku/{id}', [LibraryController::class, 'edit_buku'])->name('buku.edit');

    Route::post('/dashboard', [LibraryController::class, 'store_siswa'])->name('siswa.store');
    Route::put('/dashboard/{id}', [LibraryController::class, 'edit_siswa'])->name('siswa.edit');
    Route::delete('/dashboard/{id}', [LibraryController::class, 'delete_siswa'])->name('siswa.delete');

});
Route::prefix('petugas')->middleware('auth:petugas')->group(function (){
    Route::get('/dashboard', [LibraryController::class, 'index_petugas'])->name('dashboard_petugas');
    Route::get('/buku', [LibraryController::class, 'panelBukuPetugas'])->name('panel_buku_petugas');
    Route::get('/bukuonline', [BukuOnlineController::class, 'panelBukuOnline'])->name('panel_buku_online');
    Route::get('/daftarpeminjaman', [LibraryController::class, 'panelPeminjamanPetugas'])->name('panel_peminjaman_petugas');
    Route::get('/peminjaman/download-pdf', [PeminjamanController::class, 'downloadPDF'])->name('peminjaman.download-pdf');

    Route::put('/peminjaman/{id}/confirm', [PeminjamanController::class, 'confirm'])->name('peminjaman.confirm');
    Route::delete('/buku/{id}', [LibraryController::class, 'delete_buku_petugas'])->name('buku.delete');
    Route::post('/buku', [LibraryController::class, 'create_buku_petugas'])->name('buku.create');
    Route::put('/buku/{id}', [LibraryController::class, 'edit_buku_petugas'])->name('buku.edit');

    // Rute untuk kategori
    Route::get('/kategori', [LibraryController::class, 'panelKategoriPetugas'])->name('panel_kategori_petugas');
    Route::post('/kategori', [CategoryController::class, 'create_category'])->name('kategori.create');
    Route::put('/kategori/{id}', [CategoryController::class, 'edit_category'])->name('kategori.edit');
    Route::delete('/kategori/{id}', [CategoryController::class, 'delete_category'])->name('kategori.delete');

    Route::post('/buku_online/create', [BukuOnlineController::class, 'create_buku_online'])->name('buku_online.create');

    Route::put('/bukuonline/{id}', [BukuOnlineController::class, 'edit_buku_online'])->name('buku_online.edit');
    Route::delete('/bukuonline/{id}', [BukuOnlineController::class, 'delete_buku_online'])->name('buku_online.delete');
    Route::post('/peminjaman/return/{id}', [PeminjamanController::class, 'returnBook'])->name('peminjaman.return');

});

Route::prefix('costumer')->middleware('auth:costumer')->group(function (){
    Route::get('/dashboard', [LibraryController::class, 'landing'])->name('dashboard_costumer');
    Route::get('/online', [LibraryController::class, 'online'])->name('online_book');
    Route::get('/profil', [LibraryController::class, 'profil'])->name('profil');
    Route::put('/edit-profile/{id}', [LibraryController::class, 'editProfile'])->name('edit_profile');
    Route::get('/fetch-book-details/{id}', [LibraryController::class, 'fetchBookDetails']);

    Route::get('/data-peminjaman', [LibraryController::class, 'showDataPeminjaman'])->name('data.peminjaman');
    Route::post('/borrow/{id}', [PeminjamanController::class, 'pinjam'])->name('borrow.book');
    Route::post('/pinjam/{buku}', [PeminjamanController::class, 'pinjam'])->name('pinjam');

    Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::post('/add-to-favorite', [LibraryController::class, 'addToFavorite'])->name('add.to.favorite');
    Route::delete('/favorite/remove/{buku_id}', [LibraryController::class, 'removeFavorite'])->name('favorite.remove');

    Route::post('/reviews', [LibraryController::class, 'ulasan'])->name('reviews.store');
    Route::get('/buku/{id}/reviews', [LibraryController::class, 'getReviews'])->name('reviews.get');
});
