<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarBeasiswaController;

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

Route::get('/', [DaftarBeasiswaController::class, 'index']);
Route::get('daftar', [DaftarBeasiswaController::class, 'daftar_index']);
Route::get('cekipk/{nim}', [DaftarBeasiswaController::class, 'cek_ipk']);
Route::post('daftar', [DaftarBeasiswaController::class, 'daftar']);
Route::get('hasil', [DaftarBeasiswaController::class, 'hasil']);