<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelaporController;
use App\Http\Controllers\KaryawanController;

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
Route::get('/karyawan/laporan2', [KaryawanController::class, 'laporan2'])->name('laporan2');
Route::get('/karyawan/laporan3', [KaryawanController::class, 'laporan3'])->name('laporan3');

Route::get('/karyawan/laporan/laporandetil/{id_keluhan}', [KaryawanController::class, 'laporandetil']);

