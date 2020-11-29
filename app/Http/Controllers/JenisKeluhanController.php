<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagianModel;
use App\Models\JenisKeluhanModel;
use App\Services\PayUService\Exception;
use Ramsey\Uuid\Uuid;

class JenisKeluhanController extends Controller
{
    public function index(){
      $dataJenisKeluhan = JenisKeluhanModel::all();
      $dataBagian = BagianModel::all();
      return view('karyawan.jenis-keluhan.v_jenis_keluhan', [
        'dataJenisKeluhan' => $dataJenisKeluhan,
        'dataBagian' => $dataBagian]);
    }

    public function store(Request $request) {
      $namaKeluhan = Request()->nama_keluhan;
      $kodeBagian = Request()->kode_bagian;

      if (!$namaKeluhan || gettype($namaKeluhan) !== 'string') return response()->json([
        'status' => 400,
        'message' => 'Nama keluhan tidak boleh string kosong'
      ]);

      if (!$kodeBagian || gettype($kodeBagian) !== 'string') return response()->json([
        'status' => 400,
        'message' => 'Kode bagian tidak boleh string kosong'
      ]);

      try {
        $bagian = BagianModel::findOrFail($kodeBagian);
        if (!$kodeBagian) return response()->json([
          'status' => 404,
          'message' => 'Kode bagian tidak ditemukan'
        ]);

        $jenisKeluhan = JenisKeluhanModel::create([
          'id_jenis_keluhan' => Uuid::uuid4()->toString(),
          'nm_keluhan' => $namaKeluhan,
          'kd_bagian_fk' => $kodeBagian
        ]);
      } catch (Exception $e) {
        return response()->json([
          'status' => 500,
          'message' => $e->getMessage()
        ]);
      }

      return response()->json([
        'status' => 200,
        'message' => 'Jenis keluhan berhasil disimpan'
      ]);
    }

    public function update($id_jenis_keluhan, Request $request) {
      $idJenisKeluhan = Request()->id_jenis_keluhan;
      $namaKeluhan = Request()->nama_keluhan;
      $kodeBagian = Request()->kode_bagian;

      if (!$id_jenis_keluhan) return response()->json([
        'status' => 400,
        'message' => 'Parameter id jenis keluhan tidak boleh kosong'
      ]);

      if (!$idJenisKeluhan || gettype($idJenisKeluhan) !== 'string') return response()->json([
        'status' => 400,
        'message' => 'Id jenis keluhan tidak boleh string kosong'
      ]);

      if (!$namaKeluhan || gettype($namaKeluhan) !== 'string') return response()->json([
        'status' => 400,
        'message' => 'Nama keluhan tidak boleh string kosong'
      ]);

      if (!$kodeBagian || gettype($kodeBagian) !== 'string') return response()->json([
        'status' => 400,
        'message' => 'Kode bagian tidak boleh string kosong'
      ]);

      try {
        $bagian = BagianModel::findOrFail($kodeBagian);
        if (!$kodeBagian) return response()->json([
          'status' => 404,
          'message' => 'Kode bagian tidak ditemukan'
        ]);

        $jenisKeluhan = JenisKeluhanModel::findOrFail($id_jenis_keluhan);
        if (!$jenisKeluhan) return response()->json([
          'status' => 404,
          'message' => 'Id Jenis Keluhan tidak ditemukan'
        ]);

        $jenisKeluhan->nm_keluhan = $namaKeluhan;
        $jenisKeluhan->kd_bagian_fk = $kodeBagian;

        $jenisKeluhan->save();
      } catch (Exception $e) {
        return response()->json([
          'status' => 500,
          'message' => $e->getMessage()
        ]);
      }

      return response()->json([
        'status' => 200,
        'message' => 'Jenis keluhan berhasil diubah'
      ]);
    }

    public function delete($id_jenis_keluhan) {
      if (!$id_jenis_keluhan) return response()->json([
        'status' => 400,
        'message' => 'Parameter id jenis keluhan tidak boleh kosong'
      ]);

      try {
        $jenisKeluhan = JenisKeluhanModel::findOrFail($id_jenis_keluhan);
        if (!$jenisKeluhan) return response()->json([
          'status' => 404,
          'message' => 'Id Jenis Keluhan tidak ditemukan'
        ]);

        $jenisKeluhan->delete();
      } catch (Exception $e) {
        return response()->json([
          'status' => 500,
          'message' => $e->getMessage()
        ]);
      }

      return response()->json([
        'status' => 200,
        'message' => 'Jenis keluhan berhasil dihapus'
      ]);
    }
}
