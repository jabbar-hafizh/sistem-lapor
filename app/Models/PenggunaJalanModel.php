<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenggunaJalanModel extends Model
{
    public function dataJenisKeluhan(){
        return DB::table('jenis_keluhan')->get();
    }
    
    public function addDataKeluhan($dataKeluhan){
        DB::table('keluhan')->insertGetId($dataKeluhan);
    }

    public function addDataDetilKeluhan($dataDetilKeluhan){
        DB::table('detil_keluhan')->insertGetId($dataDetilKeluhan);
    }
}
