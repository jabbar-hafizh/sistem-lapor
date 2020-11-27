<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class KaryawanModel extends Model
{
    public function allData(){
        return DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->join('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        ->join('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        // ->where('status_keluhan', 'Baru')
        ->get();
    }
    public function allData2(){
        return DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->join('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        ->join('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        ->where('status_keluhan', 'Diproses')
        ->get();
    }
    public function allData3(){
        return DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->join('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        ->join('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        ->where('status_keluhan', 'Ditangani')
        ->get();
    }

    public function allDataLaporanDetil($id_keluhan){
        return DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->join('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        // ->join('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        ->where('id_keluhan', $id_keluhan)
        ->first();
    }

    public function allDataLaporanDetil2(){
        return DB::table('karyawan')->get();
    }
}
