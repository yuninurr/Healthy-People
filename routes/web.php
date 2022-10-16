<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JenisVaksinController;
use App\Http\Controllers\KirimEmailController;
use App\Http\Controllers\LokasiVaksinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VaksinisasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware(['admin'])->group(function () {
    Route::resource('/dokter', DokterController::class);
    Route::resource('/lokasi', LokasiVaksinController::class);
    Route::resource('/jenis_vaksin', JenisVaksinController::class);
    Route::resource('/berita', BeritaController::class);
    Route::get('/vaksinisasi-booth/{id}', [VaksinisasiController::class, 'detail_vaksinisasi_booth'])->name('detail-vaksinisasi-booth');
    Route::get('/vaksinisasi-booth', [VaksinisasiController::class, 'vaksinisasi_booth'])->name('vaksinisasi-booth');
    Route::get('/vaksinisasi-rumah', [VaksinisasiController::class, 'vaksinisasi_rumah'])->name('vaksinisasi-rumah');
    Route::get('/pemberitahuan-vaksin', [VaksinisasiController::class, 'pemberitahuan_vaksin'])->name('pemberitahuan-vaksin');
    Route::get('/set-dokter/{id}', [VaksinisasiController::class, 'set_dokter'])->name('set-dokter');
    Route::post('/simpan-verifikasi', [VaksinisasiController::class, 'simpan_verifikasi'])->name('simpan-verifikasi');
    Route::post('/set-dokter/', [VaksinisasiController::class, 'simpan_set_dokter'])->name('simpan-set-dokter');
    Route::get('/frontpage', [DashboardController::class, 'edit'])->name('edit-frontpage');
    Route::post('/frontpage', [DashboardController::class, 'update'])->name('update-frontpage');
    Route::get('/kirimemail/{id}', [KirimEmailController::class, 'index'])->name('kirim-email');
    Route::get('/email', [KirimEmailController::class, 'email'])->name('email');
});
Route::get('/', [App\Http\Controllers\DashboardController::class, 'landingpage'])->middleware('guest');
Route::get('/blog-berita/{slug}', [App\Http\Controllers\BeritaController::class, 'berita_detail'])->middleware('guest')->name('blog-berita');
Route::get('/koleksi_berita', [App\Http\Controllers\BeritaController::class, 'koleksi_berita'])->middleware('guest')->name('koleksi-berita');


//! Route::get('/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
//! Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::middleware(['user'])->group(function () {
    Route::get('/riwayat', [VaksinisasiController::class, 'index'])->name('riwayat');
    Route::get('/daftar_vaksin', [VaksinisasiController::class, 'daftar_vaksin'])->name('daftar-vaksin');
    Route::post('/simpan_daftar_vaksin', [VaksinisasiController::class, 'simpan_daftar_vaksin'])->name('simpan-daftar-vaksin');
    Route::post('/get_lokasi_vaksin', [LokasiVaksinController::class, 'get_lokasi_vaksin'])->name('get-lokasi-vaksin');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::post('/simpan_profile', [ProfileController::class, 'simpan_profile'])->name('simpan-profile');
});
