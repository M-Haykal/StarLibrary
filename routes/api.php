<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthAPIController::class, 'login']);
    Route::post('/logout', [AuthAPIController::class, 'logout']);
    Route::post('/register', [AuthAPIController::class, 'register']);
    Route::post('/edit-profile', [ApiController::class, 'editProfile']);
    Route::get('/listpeminjaman', [ApiController::class, 'listPeminjaman']);
    Route::middleware('auth:sanctum')->get('/listbuku', [BookController::class, 'listBuku']);
    Route::middleware('auth:sanctum')->get('/online', [BookController::class, 'listBukuOnline']);
    Route::middleware('auth:sanctum')->post('/pinjam/{id}', [ApiController::class, 'pinjam']);
    Route::middleware('auth:sanctum')->delete('/return/{peminjaman}', [ApiController::class, 'destroy']);
    Route::post('/reset-all-tokens', [AuthAPIController::class, 'resetAllTokens']);

});

