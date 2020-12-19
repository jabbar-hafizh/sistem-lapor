<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use App\Models\KaryawanMasterModel;
use App\Exports\KeluhanExport;
use App\Exports\KeluhanExport2;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class KaryawanController extends Controller
{
  public function __construct(){
    $this->KaryawanModel = new KaryawanModel();
  }

  public function laporan(){
    $data = [
      'karyawan'=> $this->KaryawanModel->allData(),
    ];
    return view('karyawan.v_laporan', $data);
  }

  public function laporandetil($id_keluhan){
    $data = [
      'karyawan'=> $this->KaryawanModel->allDataLaporanDetil($id_keluhan),
      'karyawan2'=> $this->KaryawanModel->allDataLaporanDetil2(),
      'filterKaryawan' => DB::table('karyawan')
        ->join('bagian', 'karyawan.kd_bagian_fk', '=', 'bagian.kd_bagian')
        ->where('nm_bagian', 'Manager')
        ->get()
    ];
    return view('karyawan.v_laporandetil', $data);
  }

  public function laporandetilbb($id_keluhan){
    $data = [
      'karyawan'=> $this->KaryawanModel->allDataLaporanDetilbb($id_keluhan),
      'karyawan2'=> $this->KaryawanModel->allDataLaporanDetil2bb(),
    ];
    return view('karyawan.v_laporandetilbb', $data);
  }

  public function updatepetugas($id_keluhan){
    $dataKeluhan = [
      'id_karyawan_fk' => Request()->id_karyawan,
      'status_keluhan' => 'Diproses',
    ];


    $this->KaryawanModel->updatePetugas($id_keluhan, $dataKeluhan);
    return redirect()->route('laporan')->with('pesan_update_petugas','Karyawan Petugas Berhasil Diupdate!');
  }

  public function selesai($id_keluhan){
    $dataKeluhan = [
      'status_keluhan' => 'Selesai',
    ];

    $this->KaryawanModel->updatePetugas($id_keluhan, $dataKeluhan);
    return redirect()->route('laporan')->with('pesan_selesai_petugas','Keluhan Berhasil Diselesaikan!');
  }

  public function ditangani($id_keluhan){
      $dataKeluhan = [
        'status_keluhan' => 'Ditangani',
      ];

      $this->KaryawanModel->updatePetugas($id_keluhan, $dataKeluhan);
      return redirect()->route('laporan')->with('pesan_ditangani_petugas','Keluhan Ditangani!');
  }

  public function sudahditangani($id_keluhan){
      $dataKeluhan = [
          'penyelesaian_keluhan' => Request()->penyelesaian_keluhan,
          'status_keluhan' => 'Selesai'
      ];

      $this->KaryawanModel->updatePetugas($id_keluhan, $dataKeluhan);
      return redirect()->route('laporan')->with('pesan_sudah_ditangani_petugas','Keluhan Sudah Ditangani!');
  }

  public function export(){
      $startDate = Request()->startdate;
      $endDate = Request()->enddate;
      $this->KaryawanModel->dataKeluhan($startDate, $endDate);
      return Excel::download(new KeluhanExport($startDate, $endDate), 'Laporan Keluhan '.date('d-m-Y').'.xlsx');
  }

  public function export2(){
      $startDate = Request()->startdate;
      $endDate = Request()->enddate;
      $namaKaryawan = Request()->namakaryawan;
      $this->KaryawanModel->dataKeluhan2($startDate, $endDate, $namaKaryawan);
      return Excel::download(new KeluhanExport2($startDate, $endDate, $namaKaryawan), 'Laporan Keluhan '.date('d-m-Y').'.xlsx');
  }

  public function filterPetugas(Request $request) {
    $tingkatKeluhan = Request()->tingkat_keluhan;

    $arrBagianFromTingkatKeluhan = array(
      'ringan' => 'Supervisor Customer Service',
      'berat' => 'Manager'
    );

    // return response()->json($arrBagianFromTingkatKeluhan[$tingkatKeluhan]);
    try {
      $tmpBagian = $arrBagianFromTingkatKeluhan[$tingkatKeluhan];
      $karyawan = DB::table('karyawan')
        ->join('bagian', 'karyawan.kd_bagian_fk', '=', 'bagian.kd_bagian')
        ->where('nm_bagian', $tmpBagian)
        ->get();
      return response()->json([
        'status' => 200,
        'message' => 'Data karyawan berhasil ditampilkan',
        'data' => [
          'karyawan' => $karyawan,
          'tingkat_keluhan' => $tingkatKeluhan,
          'bagian' => $tmpBagian
        ]
      ]);
    }
    catch (Exception $err) {
      return response()->json([
        'status' => 500,
        'message' => 'Internal Server Error',
        'error' => $err
      ]);
    }
  }

  public function ringanSelesai(Request $request) {
    $idKeluhan = Request()->id_keluhan;
    $store = [
      'penyelesaian_keluhan' => Request()->penyelesaian,
      'tingkat_keluhan' => Request()->tingkat_keluhan,
      'id_karyawan_fk' => Request()->id_karyawan,
      'status_keluhan' => Request()->status
    ];

    try {
      DB::table('keluhan')
      ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
      ->where('id_keluhan', $idKeluhan)
      ->update($store);

      return response()->json([
        'status' => 200,
        'message' => 'Laporan berhasil diselesaikan'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 500,
        'message' => 'Internal Server Error',
        'error' => $e
      ]);
    }
  }

  public function beratDiproses(Request $request) {
    $idKeluhan = Request()->id_keluhan;
    $store = [
      'tingkat_keluhan' => Request()->tingkat_keluhan,
      'id_karyawan_fk' => Request()->id_karyawan,
      'status_keluhan' => Request()->status
    ];

    try {
      DB::table('keluhan')
      ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
      ->where('id_keluhan', $idKeluhan)
      ->update($store);

      return response()->json([
        'status' => 200,
        'message' => 'Laporan berhasil diproses ke manager'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 500,
        'message' => 'Internal Server Error',
        'error' => $e
      ]);
    }
  }
}
