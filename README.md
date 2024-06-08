[![Discord Presence](https://lanyard.cnrad.dev/api/481734993622728715)](https://discord.com/users/481734993622728715)

# Library Management System

Welcome to the Library Management System! This project is designed to facilitate the management of a library's books, users, and borrowing activities. The system has distinct interfaces and functionalities for administrators, library staff (petugas), and customers (students). Additionally, it offers an API for integration with other services.

## Table of Contents

1. [Project Structure](#project-structure)
2. [Views](#views)
   - [Layout](#layout)
   - [Partials](#partials)
   - [Pages](#pages)
3. [Routes](#routes)
   - [Admin Routes](#admin-routes)
   - [Staff Routes](#petugas-routes)
   - [Customer Routes](#customer-routes)
   - [API Routes](#api-routes)
4. [Installation](#installation)
5. [Usage](#usage)

## Project Structure

The project is structured as follows:

- **views/layouts**: Contains layout files used to define the structure of different pages.
- **views/partials**: Contains partial views for components like modals, navbar, and sidebar.
- **views/admin**: Contains views specific to the admin interface.
- **views/petugas**: Contains views specific to the library staff interface.
- **views/costumer**: Contains views specific to the customer (student) interface.

## Views

### Layout

The layout files provide the basic HTML structure, including the head and closing tags, and the inclusion of scripts and styles.

- `main_index.blade.php`: Main layout for admin and staff index pages.
- `welcome.blade.php`: Layout for the student index page.

### Partials

Partial views include reusable components such as modals, navbar, and sidebar.

### Pages

- `login.blade.php`: Login page.
- `register.blade.php`: Registration page.
- `panel_buku_petugas.blade.php`: Book management panel for library staff.
- `profil.blade.php`: Profile page with jQuery/JavaScript for interactive elements.

## Routes

### Admin Routes

Routes for the admin interface are prefixed with `/admin` and require authentication.

```php
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [LibraryController::class, 'index_admin'])->name('dashboard_admin');
    Route::get('/petugas', [LibraryController::class, 'petugas_manager'])->name('petugas_manager');

    Route::get('/buku', [LibraryController::class, 'panelBukuAdmin'])->name('panel_buku_admin');

    Route::delete('/buku/{id}', [LibraryController::class, 'delete_buku'])->name('buku.delete');
    Route::post('/buku', [LibraryController::class, 'create_buku'])->name('buku.create');
    Route::put('/buku/{id}', [LibraryController::class, 'edit_buku'])->name('buku.edit');

    Route::post('/dashboard', [LibraryController::class, 'store_siswa'])->name('siswa.store');
    Route::put('/dashboard/{id}', [LibraryController::class, 'edit_siswa'])->name('siswa.edit');
    Route::delete('/dashboard/{id}', [LibraryController::class, 'delete_siswa'])->name('siswa.delete');

    Route::post('/petugas', [LibraryController::class, 'store_petugas'])->name('petugas.store');
    Route::put('/petugas/{id}', [LibraryController::class, 'edit_petugas'])->name('petugas.edit');
    Route::delete('/petugas/{id}', [LibraryController::class, 'delete_petugas'])->name('petugas.delete');
});
```
### petugas Routes

Routes for the petugas interface are prefixed with `/petugas` and require authentication.

```php
Route::prefix('petugas')->middleware('auth:petugas')->group(function () {
    Route::get('/dashboard', [LibraryController::class, 'index_petugas'])->name('dashboard_petugas');
    Route::get('/buku', [LibraryController::class, 'panelBukuPetugas'])->name('panel_buku_petugas');
    Route::get('/bukuonline', [BukuOnlineController::class, 'panelBukuOnline'])->name('panel_buku_online');
    Route::get('/daftarpeminjaman', [LibraryController::class, 'panelPeminjamanPetugas'])->name('panel_peminjaman_petugas');
    Route::get('/daftarpeminjaman/view-pdf', [PeminjamanController::class, 'downloadPDF'])->name('peminjaman.view-pdf');

    Route::put('/peminjaman/{id}/confirm', [PeminjamanController::class, 'confirm'])->name('peminjaman.confirm');
    Route::delete('/buku/{id}', [LibraryController::class, 'delete_buku_petugas'])->name('buku.delete');
    Route::post('/buku', [LibraryController::class, 'create_buku_petugas'])->name('buku.create');
    Route::put('/buku/{id}', [LibraryController::class, 'edit_buku_petugas'])->name('buku.edit');

    Route::get('/kategori', [LibraryController::class, 'panelKategoriPetugas'])->name('panel_kategori_petugas');
    Route::post('/kategori', [CategoryController::class, 'create_category'])->name('kategori.create');
    Route::put('/kategori/{id}', [CategoryController::class, 'edit_category'])->name('kategori.edit');
    Route::delete('/kategori/{id}', [CategoryController::class, 'delete_category'])->name('kategori.delete');

    Route::post('/buku_online/create', [BukuOnlineController::class, 'create_buku_online'])->name('buku_online.create');

    Route::put('/bukuonline/{id}', [BukuOnlineController::class, 'edit_buku_online'])->name('buku_online.edit');
    Route::delete('/bukuonline/{id}', [BukuOnlineController::class, 'delete_buku_online'])->name('buku_online.delete');
    Route::post('/peminjaman/return/{id}', [PeminjamanController::class, 'returnBook'])->name('peminjaman.return');
    Route::get('/peminjaman/search', [PeminjamanController::class, 'search'])->name('peminjaman.search');
});
```
### costumer Routes

Routes for the admin interface are prefixed with `/costumer` and require authentication.

```php
Route::prefix('costumer')->middleware('auth:costumer')->group(function () {
    Route::get('/dashboard', [LibraryController::class, 'landing'])->name('dashboard_costumer');
    Route::get('/online', [LibraryController::class, 'online'])->name('online_book');
    Route::get('/profil', [LibraryController::class, 'profil'])->name('profil');
    Route::put('/edit-profile/{id}', [LibraryController::class, 'editProfile'])->name('edit_profile');
    Route::get('/fetch-book-details/{id}', [LibraryController::class, 'fetchBookDetails']);

    Route::get('/data-peminjaman', [LibraryController::class, 'showDataPeminjaman'])->name('data.peminjaman');
    Route::post('/borrow/{id}', [PeminjamanController::class, 'pinjam'])->name('borrow.book');
    Route::post('/pinjam/{buku}', [PeminjamanController::class, 'pinjam'])->name('pinjam');

    Route::put('/peminjaman/{peminjaman}', [PeminjamanController::class, 'cancel'])->name('peminjaman.cancel');
    Route::post('/add-to-favorite', [LibraryController::class, 'addToFavorite'])->name('add.to.favorite');
    Route::delete('/favorite/remove/{buku_id}', [LibraryController::class, 'removeFavorite'])->name('favorite.remove');

    Route::post('/reviews', [LibraryController::class, 'ulasan'])->name('reviews.store');
    Route::get('/buku/{id}/reviews', [LibraryController::class, 'getReviews'])->name('reviews.get');
});
```
### Api Routes

Routes for the admin interface are prefixed with `/api/auth` and require authentication.
```php
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthAPIController::class, 'login']); // API LOGIN MENGGENERATE TOKEN SANCTUM
    Route::post('/logout', [AuthAPIController::class, 'logout']); // API LOGOUT
    Route::post('/register', [AuthAPIController::class, 'register']); // API REGISTER
    Route::post('/edit-profile', [ApiController::class, 'editProfile']); // API EDIT PROFILE
    Route::get('/listpeminjaman', [ApiController::class, 'listPeminjaman']); //API Menampilkan Semua Peminjaman
    Route::post('/ulasan', [ApiController::class, 'ulasan']); // APi Mnegirim Ulasan
    Route::get('/reviews/{id}', [ApiController::class, 'getReviews']); // Api menampilkan ulasan setiap buku ID
    Route::post('/favorite', [ApiController::class, 'addFavorite']); // Api Add Favorite
    Route::delete('/favorite', [ApiController::class, 'removeFavorite']); // Api remove favorite
    Route::get('/favorite', [ApiController::class, 'listallfav']); // Api get all user favorite
    Route::middleware('auth:sanctum')->get('/listbuku', [BookController::class, 'listBuku']); // api semua list buku menggunakan auth sanctum
    Route::middleware('auth:sanctum')->get('/online', [BookController::class, 'listBukuOnline']); // api list online buku 
    Route::post('/pinjam/{id}', [ApiController::class, 'pinjam']); // Api Pinjam mengambil data costumer menggunakan TOKEN
    Route::middleware('auth:sanctum')->put('/pinjam/{id}', [ApiController::class, 'cancelpeminjaman']); // Api Pembatalan Peminjaman Mengubah status menjadi cancelled
    Route::middleware('auth:sanctum')->delete('/return/{peminjaman}', [ApiController::class, 'destroy']); 
    Route::middleware('auth:sanctum')->post('/reset-all-tokens', [AuthAPIController::class, 'resetAllTokens']); // Api Untuk menghapus semua token
});
```
## usage
- admin account. admin@amwp.websiite , amwp//63935845
- Access the petugas Account (Login To admin and go to petugas manager)
- Use the API endpoints to integrate with other services.
