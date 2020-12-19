<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $fillable = ['id_karyawan', 'nm_karyawan', 'alamat', 'no_telp', 'kd_bagian_fk', 'password', 'shift'];
    protected $primaryKey = 'id_karyawan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function bagian()
    {
        return $this->belongsTo(BagianModel::class, 'kd_bagian_fk', 'kd_bagian');
    }

    public function allData(){
        return DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->join('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        // ->join('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        // ->where('status_keluhan', 'Baru')
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

    public function allDataLaporanDetilbb($id_keluhan){
        return DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->join('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        ->join('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        ->where('id_keluhan', $id_keluhan)
        ->first();
    }

    public function allDataLaporanDetil2bb(){
        return DB::table('karyawan')->get();
    }

    public function updatePetugas($id_keluhan, $dataKeluhan){
        DB::table('keluhan')
        ->join('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->where('id_keluhan', $id_keluhan)
        ->update($dataKeluhan);
    }


    public function dataKeluhan($startDate, $endDate){
        return DB::table('keluhan')
        ->leftjoin('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->leftjoin('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        ->leftjoin('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        ->orderBy('keluhan.waktu_keluhan', 'desc')
        // ->where('status_keluhan', 'Baru')
        ->select(
            'nm_keluhan',
            'penjelasan_keluhan',
            'waktu_keluhan',
            'nm_pengeluh',
            'keluhan.no_telp as no_telp1',
            'status_keluhan',
            'nm_karyawan',
            'karyawan.no_telp as no_telp2',
        )
        ->where('waktu_keluhan', '>=', $startDate)
        ->where('waktu_keluhan', '<=', $endDate)
        ->get();
    }

    public function dataKeluhan2($startDate, $endDate, $namaKaryawan){
        return DB::table('keluhan')
        ->leftjoin('detil_keluhan', 'keluhan.id_keluhan', '=', 'detil_keluhan.id_keluhan_fk')
        ->leftjoin('jenis_keluhan', 'detil_keluhan.id_jenis_keluhan_fk', '=', 'jenis_keluhan.id_jenis_keluhan')
        ->leftjoin('karyawan', 'keluhan.id_karyawan_fk', '=', 'karyawan.id_karyawan')
        ->orderBy('keluhan.waktu_keluhan', 'desc')
        // ->where('status_keluhan', 'Baru')
        ->select(
            'nm_keluhan',
            'penjelasan_keluhan',
            'waktu_keluhan',
            'nm_pengeluh',
            'keluhan.no_telp as no_telp1',
            'status_keluhan',
            'nm_karyawan',
            'karyawan.no_telp as no_telp2',
        )
        ->where('waktu_keluhan', '>=', $startDate)
        ->where('waktu_keluhan', '<=', $endDate)
        ->where('nm_karyawan', '=', $namaKaryawan)
        ->get();
    }
}
