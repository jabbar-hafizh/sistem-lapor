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

    public function addDataKaryawan($dataKaryawan){
        DB::table('karyawan')->insert($dataKaryawan);
    }
}
