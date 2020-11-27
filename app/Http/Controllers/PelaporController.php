<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelaporModel;
use Illuminate\Support\Facades\DB;

class PelaporController extends Controller
{
    public function __construct(){
        $this->PelaporModel = new PelaporModel();
    }

    public function lapor(){
        $data = [
            'pelapor'=> $this->PelaporModel->allData(),
        ];
        return view('pelapor.v_lapor', $data);
    }

    public function insertKeluhan(){
        Request()->validate(
            [
                'nm_pengeluh' => 'required|max:50',
                'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:13',

                'id_jenis_keluhan_fk' => 'required',
                'penjelasan_keluhan' => 'required|max:255',
                'bukti_foto_keluhan' => 'required|mimes:jpg,jpeg,bmp,png',
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

                'no_telp.regex' => '*Isi dengan nomor!',
                'no_telp.min' => '*Nomor telpon minimal 8 karakter',

                'bukti_foto_keluhan.mimes' => '*Format file harus jpg, jpeg, png, atau bmp!',
            ]
        );


        $dataKeluhan = [
            'nm_pengeluh' => Request()->nm_pengeluh,
            'no_telp' => Request()->no_telp,
        ];

        $this->PelaporModel->addDataKeluhan($dataKeluhan);
        


        $file = Request()->bukti_foto_keluhan;
        $fileName = DB::getPdo()->lastInsertId().'.'.$file->extension();
        $file = $file->move(public_path('img'), $fileName);

        $dataDetilKeluhan = [
            'id_keluhan_fk' => DB::getPdo()->lastInsertId(),
            'id_jenis_keluhan_fk' => Request()->id_jenis_keluhan_fk,
            'penjelasan_keluhan' => Request()->penjelasan_keluhan,
            'bukti_foto_keluhan' => $fileName,
            'status_keluhan' => 'Baru',
        ];

        $this->PelaporModel->addDataDetilKeluhan($dataDetilKeluhan);
        return redirect()->route('addkeluhan')->with('pesan_keluhan','Data Berhasil Dikirim!');
    }
}
