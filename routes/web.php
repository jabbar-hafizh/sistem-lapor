<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelaporController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\JenisKeluhanController;

Route::get('/', [HomeController::class, 'home']);
Route::get('/pelapor/addkeluhan', [PelaporController::class, 'lapor'])->name('addkeluhan');
Route::post('/pelapor/insertkeluhan', [PelaporController::class, 'insertKeluhan'])->name('insertkeluhan');


Route::get('/karyawan/laporan', [KaryawanController::class, 'laporan'])->name('laporan');
Route::get('/karyawan/laporan2', [KaryawanController::class, 'laporan2'])->name('laporan2');
Route::get('/karyawan/laporan3', [KaryawanController::class, 'laporan3'])->name('laporan3');

Route::get('/karyawan/laporan/laporandetil/{id_keluhan}', [KaryawanController::class, 'laporandetil']);

// Bagian
Route::get('/bagian', [BagianController::class, 'index']);
Route::post('/bagian/store', [BagianController::class, 'store']);
Route::put('/bagian/{id_bagian}/update', [BagianController::class, 'update']);
Route::delete('bagian/{id_bagian}/delete', [BagianController::class, 'delete']);

// Jenis Keluhan
Route::get('/jenis-keluhan', [JenisKeluhanController::class, 'index']);
Route::post('/jenis-keluhan/store', [JenisKeluhanController::class, 'store']);
Route::put('/jenis-keluhan/{id_jenis_keluhan}/update', [JenisKeluhanController::class, 'update']);
Route::delete('jenis-keluhan/{id_jenis_keluhan}/delete', [JenisKeluhanController::class, 'delete']);
