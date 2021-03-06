<?php

namespace App\Http\Controllers;

use App\Models\PenggunaJalanModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PenggunaJalanController extends Controller
{
    public function __construct(){
        $this->PenggunaJalanModel = new PenggunaJalanModel();
    }

    public function index(){
        $data = [
            'jenis_keluhan'=> $this->PenggunaJalanModel->dataJenisKeluhan(),
        ];
        return view('pengguna_jalan.v_pengguna_jalan', $data);
    }

    public function insertKeluhan(){
        Request()->validate(
            [
                'nm_pengeluh' => 'required|max:50',
                'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:13',

                'id_jenis_keluhan_fk' => 'required',
                'penjelasan_keluhan' => 'required|max:255',
                'bukti_foto_keluhan' => 'required|mimes:jpg,jpeg,bmp,png|max:5012',
            ],
            [
                'nm_pengeluh.required' => '*Nama harus diisi!',
                'no_telp.required' => '*Nomor Telepon harus diisi!',
                'id_jenis_keluhan_fk.required' => '*Pilih jenis keluhan',
                'penjelasan_keluhan.required' => '*Harus diisi!',
                'bukti_foto_keluhan.required' => '*Upload bukti foto',

                'nm_pengeluh.max' => '*Nama maksimal 50 karakter!',
                'no_telp.max' => '*Nomor telpon maksimal 13 karakter!',
                'penjelasan_keluhan.max' => '*Penjelasan maksimal 255 karakter!',
                'bukti_foto_keluhan.max' => '*Maxsimal size dari gambar adalah 5 MB',

                'no_telp.regex' => '*Isi dengan nomor!',
                'no_telp.min' => '*Nomor telpon minimal 8 karakter',

                'bukti_foto_keluhan.mimes' => '*Format file harus jpg, jpeg, png, atau bmp!',
            ]
        );


        $dataKeluhan = [
          'id_keluhan' => Uuid::uuid4()->toString(),
          'nm_pengeluh' => Request()->nm_pengeluh,
          'no_telp' => Request()->no_telp,
        ];

        $this->PenggunaJalanModel->addDataKeluhan($dataKeluhan);

        $file = Request()->bukti_foto_keluhan;
        $fileName = 'KLH-'.time().'.'.$file->extension();
        $file = $file->move(public_path('img'), $fileName);

        $dataDetilKeluhan = [
            'id_keluhan_fk' => $dataKeluhan['id_keluhan'],
            'id_jenis_keluhan_fk' => Request()->id_jenis_keluhan_fk,
            'penjelasan_keluhan' => Request()->penjelasan_keluhan,
            'bukti_foto_keluhan' => $fileName,
            'status_keluhan' => 'Baru',
        ];

        $this->PenggunaJalanModel->addDataDetilKeluhan($dataDetilKeluhan);
        return redirect()->route('pengguna_jalan')->with('pesan_keluhan','Data Berhasil Dikirim!');
    }
}
