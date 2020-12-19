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
      return view('karyawan.jenis-keluhan.v_jenis_keluhan', [
        'dataJenisKeluhan' => $dataJenisKeluhan
      ]);
    }

    public function store(Request $request) {
      $namaKeluhan = Request()->nama_keluhan;

      if (!$namaKeluhan || gettype($namaKeluhan) !== 'string') return response()->json([
        'status' => 400,
        'message' => 'Nama keluhan tidak boleh string kosong'
      ]);

      try {
        $jenisKeluhan = JenisKeluhanModel::create([
          'id_jenis_keluhan' => Uuid::uuid4()->toString(),
          'nm_keluhan' => $namaKeluhan
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

      try {
        $jenisKeluhan = JenisKeluhanModel::findOrFail($id_jenis_keluhan);
        if (!$jenisKeluhan) return response()->json([
          'status' => 404,
          'message' => 'Id Jenis Keluhan tidak ditemukan'
        ]);

        $jenisKeluhan->nm_keluhan = $namaKeluhan;

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
