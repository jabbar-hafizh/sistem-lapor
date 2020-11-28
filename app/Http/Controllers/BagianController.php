<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagianModel;

class BagianController extends Controller
{
    public function index(){
      $dataBagian = BagianModel::all();
      return view('karyawan.bagian.v_bagian_index', ['dataBagian' => $dataBagian]);
    }
}
