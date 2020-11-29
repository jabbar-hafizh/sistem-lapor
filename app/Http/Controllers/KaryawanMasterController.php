<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanMasterModel;


class KaryawanMasterController extends Controller
{
    public function __construct(){
        $this->KaryawanMasterModel = new KaryawanMasterModel();
    }

    public function index(){
        $data = [
            'karyawan_m'=> $this->KaryawanMasterModel->allData(),
        ];
        return view('karyawan.karyawan_master.v_karyawan', $data);
    }

    public function insertKaryawan(){
        Request()->validate(
            [
                'id_karyawan' => 'required|unique:posts|max:36',
                'password' => 'required|min:8|max:12',
                'nm_karyawan' => 'required|max:50',
                'alamat' => 'required|max:255',
                'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:13',
                'kd_bagian_fk' => 'required',
            ],
            [
                'id_karyawan.required' => '*ID Karyawan harus diisi!',
                'password.required' => '*Password harus diisi!',
                'nm_karyawan.required' => '*Nama Karyawan harus diisi!',
                'alamat.required' => '*Alamat harus diisi!',
                'no_telp.required' => '*No. Telepon harus diisi!',
                'kd_bagian_fk.required' => '*Silahkan pilih bagian!',
                
                'id_karyawan.max' => '*ID Karyawan maksimal 36 karakter!',
                'password.max' => '*Password maksimal 12 karakter!',
                'nm_karyawan.max' => '*Nama Karyawan maksimal 50 karakter!',
                'alamat.max' => '*Alamat maksimal 255 karakter!',
                'no_telp.max' => '*Password maksimal 13 karakter!',

                'no_telp.regex' => '*Isi dengan nomor!',
                'no_telp.min' => '*Nomor telpon minimal 8 karakter',
                'password.min' => '*Password minimal 8 karakter',

                'id_karyawan.unique' => 'ID Karyawan sudah ada, silahkan refresh untuk mendapatkan ID baru!',
            ]
        );


        $dataKaryawan = [
            'id_karyawan' => Request()->id_karyawan,
            'password' => Request()->password,
            'nm_karyawan' => Request()->nm_karyawan,
            'alamat' => Request()->alamat,
            'no_telp' => Request()->no_telp,
            'kd_bagian_fk' => Request()->kd_bagian,
        ];

        $this->KaryawanModel->addDataKaryawan($dataKaryawan);
        return redirect()->route('karyawan-master')->with('pesan_add_karyawan','Data Berhasil Ditambahkan!');
    }
}
