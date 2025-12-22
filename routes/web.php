<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect('/beranda');
});
Route::middleware('ceklogin')->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman/tambah', [PeminjamanController::class, 'tambah']);
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda/detail/{id_buku}', [BerandaController::class, 'detail'])->name('detail');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/cek', [LoginController::class, 'cek'])->name('login.cek');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/user', [UserController::class, 'index']);
Route::post('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/edit', [UserController::class, 'edit']);
Route::get('/user/hapus/{id_user}', [UserController::class, 'hapus']);

Route::get('/anggota', [AnggotaController::class, 'index']);
Route::post('/anggota/tambah', [AnggotaController::class, 'tambah']);
Route::post('/anggota/edit', [AnggotaController::class, 'edit']);
Route::get('/anggota/hapus/{id_anggota}', [AnggotaController::class, 'hapus']);

Route::get('/buku', [BukuController::class, 'index'])->name('index');
Route::post('/buku/tambah', [BukuController::class, 'tambah'])->name('tambah');
Route::post('/buku/update/{id_buku}', [BukuController::class, 'update'])->name('update');
Route::get('/buku/hapus/{id_buku}', [BukuController::class, 'hapus'])->name('hapus');

Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::post('/peminjaman/tambah', [PeminjamanController::class, 'tambah']);
Route::get('/peminjaman/kembalikan/{id_peminjaman}', [PeminjamanController::class, 'kembalikan']);
Route::get('/peminjaman/cek', [PeminjamanController::class, 'cek'])->name('cek');
Route::get('/peminjaman/cetak', [PeminjamanController::class, 'cetak'])->name('cetak');

Route::get('/denda', [DendaController::class, 'index'])->name('index');
Route::post('/denda/update/{id_denda}', [DendaController::class, 'update'])->name('update');