<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelaporController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\BagianController;

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

// Route::get('/', function () {
//     return view('v_index');
// });

Route::get('/', [HomeController::class, 'home']);
Route::get('/pelapor/addkeluhan', [PelaporController::class, 'lapor'])->name('addkeluhan');
Route::post('/pelapor/insertkeluhan', [PelaporController::class, 'insertKeluhan'])->name('insertkeluhan');


Route::get('/karyawan/laporan', [KaryawanController::class, 'laporan'])->name('laporan');

Route::get('/karyawan/laporan/laporandetil/{id_keluhan}', [KaryawanController::class, 'laporandetil']);
Route::get('/karyawan/laporan/laporandetilbb/{id_keluhan}', [KaryawanController::class, 'laporandetilbb']);
Route::put('/karyawan/laporan/laporandetilbb/updatepetugas/{id_keluhan}', [KaryawanController::class, 'updatepetugas']);

// Bagian
// Route::get('/bagian', [BagianController::class, 'index']);
// Route::post('/bagian/store', [BagianController::class, 'store'])
// Route::put('/bagian/{id_bagian}/update', [BagianController::class, 'update'])
// Route::delete('bagian/{id_bagian}/delete', [BagianController::class, 'delete'])

// // Jenis Keluhan
// Route::get('/jenis-keluhan', [BagianController::class, 'index'])
// Route::post('/jenis-keluhan/store', [BagianController::class, 'store'])
// Route::put('/jenis-keluhan/{id_jenis_keluhan}/update', [BagianController::class, 'update'])
// Route::delete('bagian/{id_jenis_keluhan}/delete', [BagianController::class, 'delete'])
