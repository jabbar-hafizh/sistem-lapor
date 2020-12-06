<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KaryawanMasterModel extends Model
{
    public function allData(){
        return DB::table('karyawan')
        ->join('bagian', 'karyawan.kd_bagian_fk', '=', 'bagian.kd_bagian')
        ->get();
    }

    public function dataBagian(){
        return DB::table('bagian')->get();
    }

    public function addDataKaryawan($dataKaryawan){
        DB::table('karyawan')->insert($dataKaryawan);
    }

    public function allDataEdit($id_karyawan){
        return DB::table('karyawan')
        ->join('bagian', 'karyawan.kd_bagian_fk', '=', 'bagian.kd_bagian')
        ->where('id_karyawan', $id_karyawan)
        ->first();
    }

    public function updateDataKaryawan($id_karyawan, $dataKaryawan){
        DB::table('karyawan')
        ->where('id_karyawan', $id_karyawan)
        ->update($dataKaryawan);
    }

    public function deleteDataKaryawan($id_karyawan){
        DB::table('karyawan')
        ->where('id_karyawan', $id_karyawan)
        ->delete();
    }
}
