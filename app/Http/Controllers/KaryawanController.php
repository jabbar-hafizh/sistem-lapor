<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanModel;

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

    public function laporan2(){
        $data = [
            'karyawan'=> $this->KaryawanModel->allData2(),
        ];
        return view('karyawan.v_laporan2', $data);
    }

    public function laporan3(){
        $data = [
            'karyawan'=> $this->KaryawanModel->allData3(),
        ];
        return view('karyawan.v_laporan3', $data);
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
}
