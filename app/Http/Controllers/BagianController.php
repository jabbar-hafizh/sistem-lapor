<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagianModel;
use Ramsey\Uuid\Uuid;
use App\Services\PayUService\Exception;

class BagianController extends Controller
{
  public function index(){
    $dataBagian = BagianModel::all();
    return view('karyawan.bagian.v_bagian_index', ['dataBagian' => $dataBagian]);
  }

  public function store(Request $request) {
    $namaBagian = Request()->nama_bagian;

    if (!$namaBagian || gettype($namaBagian) !== 'string') return response()->json([
      'status' => 400,
      'message' => 'Nama bagian tidak boleh string kosong'
    ]);

    try {
      BagianModel::create([
        'kd_bagian' => Uuid::uuid4()->toString(),
        'nm_bagian' => $namaBagian
      ]);
    } catch (Exception $e) {
      return response()->json([
        'status' => 500,
        'message' => $e->getMessage()
      ]);
    }

    return response()->json([
      'status' => 200,
      'message' => 'Bagian berhasil disimpan'
    ]);
  }

  public function update($id_bagian, Request $request) {
    $namaBagian = Request()->nama_bagian;
    if (!$namaBagian || gettype($namaBagian) !== 'string') return response()->json([
      'status' => 400,
      'message' => 'Nama bagian tidak boleh string kosong'
    ]);

    if (!$id_bagian || gettype($id_bagian) !== 'string') return response()->json([
      'status' => 400,
      'message' => 'Kode bagian tidak boleh string kosong'
    ]);

    try {
      $bagian = BagianModel::findOrFail($id_bagian);
      if (!$bagian) return response()->json([
        'status' => 404,
        'message' => 'Bagian tidak ditemukan'
      ]);

      $bagian->nm_bagian = $namaBagian;

      $bagian->save();
    } catch (Exception $e) {
      return response()->json([
        'status' => 500,
        'message' => $e->getMessage()
      ]);
    }

    return response()->json([
      'status' => 200,
      'message' => 'Bagian berhasil diubah'
    ]);
  }

  public function delete($id_bagian) {
    if (!$id_bagian) return response()->json([
      'status' => 400,
      'message' => 'Parameter id bagian tidak boleh kosong'
    ]);

    try {
      $bagian = BagianModel::findOrFail($id_bagian);
      if (!$id_bagian) return response()->json([
        'status' => 404,
        'message' => 'Id bagian tidak ditemukan'
      ]);

      $bagian->delete();
    } catch (Exception $e) {
      return response()->json([
        'status' => 500,
        'message' => $e->getMessage()
      ]);
    }

    return response()->json([
      'status' => 200,
      'message' => 'Bagian berhasil dihapus'
    ]);
  }
}
