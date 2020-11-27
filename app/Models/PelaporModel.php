<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PelaporModel extends Model
{
    public function allData(){
        return DB::table('jenis_keluhan')->get();
    }

    public function addDataKeluhan($dataKeluhan){
        DB::table('keluhan')->insertGetId($dataKeluhan);
    }

    public function addDataDetilKeluhan($dataDetilKeluhan){
        DB::table('detil_keluhan')->insertGetId($dataDetilKeluhan);
    }
}
