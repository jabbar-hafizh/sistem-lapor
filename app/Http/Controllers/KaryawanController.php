<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanModel;
use App\Exports\KeluhanExport;
use Maatwebsite\Excel\Facades\Excel;

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
            'status_keluhan' => 'Sudah Ditangani',
        ];

        $this->KaryawanModel->updatePetugas($id_keluhan, $dataKeluhan);
        return redirect()->route('laporan')->with('pesan_sudah_ditangani_petugas','Keluhan Sudah Ditangani!');
    }

    public function export(){
        $startDate = Request()->startdate;
        $endDate = Request()->enddate;
        $this->KaryawanModel->dataKeluhan($startDate, $endDate);
        return Excel::download(new KeluhanExport($startDate, $endDate), 'Keluhan.xlsx');
    }
}
