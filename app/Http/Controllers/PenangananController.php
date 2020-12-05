<?php

namespace App\Http\Controllers;
use App\Models\PenangananModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PenangananController extends Controller
{
    public function __construct(){
        $this->PenangananModel = new PenangananModel();
    }

    public function index(){
        $data = [
            'penanganan'=> $this->PenangananModel->allData(),
        ];
        return view('karyawan.penanganan.v_penanganan', $data);
    }
}
