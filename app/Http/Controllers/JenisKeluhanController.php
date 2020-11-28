<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagianModel;
use App\Models\JenisKeluhanModel;
class JenisKeluhanController extends Controller
{
    public function index(){
      $dataJenisKeluhan = JenisKeluhanModel::all();
      $dataBagian = BagianModel::all();
      return view('karyawan.jenis-keluhan.v_jenis_keluhan', [
        'dataJenisKeluhan' => $dataJenisKeluhan,
        'dataBagian' => $dataBagian]);
    }

    public function store(Request $request) {

    }

    public function update(Request $request) {

    }

    public function delete(Request $request) {

    }
}
