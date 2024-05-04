<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/registration', [PageController::class, 'registration'])->name('registration');
Route::get('/StarLibrary/user', [PageController::class, 'index'])->name('index');
Route::get('/StarLibrary/admin', [AdminController::class, 'index']);
Route::get('/StarLibrary/user/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/StarLibrary/favorite', [PageController::class, 'favorite'])->name('favorite');
Route::get('/StarLibrary/book/online', [PageController::class, 'online'])->name('online');
Route::get('/StarLibrary/book/offline', [PageController::class, 'offline'])->name('offline');
Route::get('/StarLibrary/admin/databuku', [PageController::class, 'databuku'])->name('databuku');
Route::get('/StarLibrary/admin/datapinjam', [PageController::class, 'datapinjam'])->name('datapinjam');
Route::get('/StarLibrary/admin/datauser', [PageController::class, 'datauser'])->name('datauser');