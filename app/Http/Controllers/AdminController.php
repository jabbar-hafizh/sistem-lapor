<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;

class AdminController extends Controller
{
    public function __construct(){
        $this->AdminModel = new AdminModel();
    }

    public function index(){
        $data = [
            'admin'=> $this->AdminModel->allData(),
        ];
        return view('v_index', $data);
    }

    public function datausers(){
        $data = [
            'admin'=> $this->AdminModel->allData(),
        ];
        return view('layout.admin.v_datausers', $data);
    }

    public function profiladmin(){
        $data = [
            'admin'=> $this->AdminModel->allData(),
        ];
        return view('layout.admin.v_profiladmin', $data);
    }

    public function detail($id_report){
        $data = [
            'admin'=> $this->AdminModel->detailData($id_report),
        ];
        return view('layout.admin.v_detillaporan', $data);
    }
}
