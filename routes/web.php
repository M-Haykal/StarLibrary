<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

Route::get('/StarLibrary/user', [AuthController::class, 'index'])->name('index');
Route::get('/StarLibrary/borrowing', [AuthController::class, 'borrowing'])->name('borrowing');
Route::get('/StarLibrary/admin', [AdminController::class, 'index']);
Route::get('/StarLibrary/user/profile', [UserController::class, 'profile'])->name('profile');
// Route::get('/StarLibrary/profile/user', [UserController::class, 'profile'])->name('profile');