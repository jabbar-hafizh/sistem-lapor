<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanMasterModel;
use Illuminate\Support\Facades\Hash;


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
    public function add(){
      $data = [
        'karyawan_m'=> $this->KaryawanMasterModel->dataBagian(),
      ];
      return view('karyawan.karyawan_master.v_karyawan_add', $data);
    }
    public function edit($id_karyawan){
      $data = [
        'karyawan_m'=> $this->KaryawanMasterModel->allDataEdit($id_karyawan),
        'karyawan_m2'=> $this->KaryawanMasterModel->dataBagian(),
      ];
      return view('karyawan.karyawan_master.v_karyawan_edit', $data);
    }

    public function insertKaryawan(){
      Request()->validate(
        [
          'id_karyawan' => 'required|unique:karyawan|max:36',
          'password' => 'required|min:8|max:12',
          'nm_karyawan' => 'required|max:50',
          'alamat' => 'required|max:255',
          'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:13',
          'kd_bagian_fk' => 'required',
          'shift' => 'required'
        ],
        [
          'id_karyawan.required' => '*ID Karyawan harus diisi!',
          'password.required' => '*Password harus diisi!',
          'nm_karyawan.required' => '*Nama Karyawan harus diisi!',
          'alamat.required' => '*Alamat harus diisi!',
          'no_telp.required' => '*No. Telepon harus diisi!',
          'kd_bagian_fk.required' => '*Silahkan pilih bagian!',
          'shift' => '*Shift harus diisi',

          'id_karyawan.max' => '*ID Karyawan maksimal 36 karakter!',
          'password.max' => '*Password maksimal 12 karakter!',
          'nm_karyawan.max' => '*Nama Karyawan maksimal 50 karakter!',
          'alamat.max' => '*Alamat maksimal 255 karakter!',
          'no_telp.max' => '*Nomor Telepon maksimal 13 karakter!',

          'no_telp.regex' => '*Isi dengan nomor!',
          'no_telp.min' => '*Nomor telepon minimal 8 karakter',
          'password.min' => '*Password minimal 8 karakter',

          'id_karyawan.unique' => 'ID Karyawan sudah ada, silahkan refresh untuk mendapatkan ID baru!',
        ]
      );


      $dataKaryawan = [
        'id_karyawan' => Request()->id_karyawan,
        'password' => Hash::make(Request()->password),
        'nm_karyawan' => Request()->nm_karyawan,
        'alamat' => Request()->alamat,
        'no_telp' => Request()->no_telp,
        'kd_bagian_fk' => Request()->kd_bagian_fk,
        'shift' => Request()->shift
      ];

      $this->KaryawanMasterModel->addDataKaryawan($dataKaryawan);
      return redirect()->route('karyawan-add')->with('pesan_add_karyawan','Data Berhasil Ditambahkan!');
    }

    public function update($id_karyawan){
      if(Request()->password <> ""){
        Request()->validate(
          [
            'id_karyawan' => 'required|max:36',
            'password' => 'required|min:8|max:12',
            'nm_karyawan' => 'required|max:50',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:13',
            'kd_bagian_fk' => 'required',
            'shift' => 'required'
          ],
          [
            'id_karyawan.required' => '*ID Karyawan harus diisi!',
            'password.required' => '*Password harus diisi!',
            'nm_karyawan.required' => '*Nama Karyawan harus diisi!',
            'alamat.required' => '*Alamat harus diisi!',
            'no_telp.required' => '*No. Telepon harus diisi!',
            'kd_bagian_fk.required' => '*Silahkan pilih bagian!',
            'shift' => '*Shift harus diisi',

            'id_karyawan.max' => '*ID Karyawan maksimal 36 karakter!',
            'password.max' => '*Password maksimal 12 karakter!',
            'nm_karyawan.max' => '*Nama Karyawan maksimal 50 karakter!',
            'alamat.max' => '*Alamat maksimal 255 karakter!',
            'no_telp.max' => '*Nomor Telepon maksimal 13 karakter!',

            'no_telp.regex' => '*Isi dengan nomor!',
            'no_telp.min' => '*Nomor telepon minimal 8 karakter',
            'password.min' => '*Password minimal 8 karakter',
          ]
        );
          // jika ingin ganti password
        $dataKaryawan = [
          'id_karyawan' => Request()->id_karyawan,
          'password' => Hash::make(Request()->password),
          'nm_karyawan' => Request()->nm_karyawan,
          'alamat' => Request()->alamat,
          'no_telp' => Request()->no_telp,
          'kd_bagian_fk' => Request()->kd_bagian_fk,
          'shift' => Request()->shift
        ];
        $this->KaryawanMasterModel->updateDataKaryawan($id_karyawan, $dataKaryawan);
      } else {
        Request()->validate(
          [
            'id_karyawan' => 'required|max:36',
            'nm_karyawan' => 'required|max:50',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:13',
            'kd_bagian_fk' => 'required',
            'shift' => 'required'
          ],
          [
            'id_karyawan.required' => '*ID Karyawan harus diisi!',
            'nm_karyawan.required' => '*Nama Karyawan harus diisi!',
            'alamat.required' => '*Alamat harus diisi!',
            'no_telp.required' => '*No. Telepon harus diisi!',
            'kd_bagian_fk.required' => '*Silahkan pilih bagian!',
            'shift' => '*Shift harus diisi',

            'id_karyawan.max' => '*ID Karyawan maksimal 36 karakter!',
            'nm_karyawan.max' => '*Nama Karyawan maksimal 50 karakter!',
            'alamat.max' => '*Alamat maksimal 255 karakter!',
            'no_telp.max' => '*Nomor Telepon maksimal 13 karakter!',

            'no_telp.regex' => '*Isi dengan nomor!',
            'no_telp.min' => '*Nomor telepon minimal 8 karakter',
          ]
        );
          // jika tidak ingin ganti password
        $dataKaryawan = [
          'id_karyawan' => Request()->id_karyawan,
          'nm_karyawan' => Request()->nm_karyawan,
          'alamat' => Request()->alamat,
          'no_telp' => Request()->no_telp,
          'kd_bagian_fk' => Request()->kd_bagian_fk,
          'shift' => Request()->shift
        ];
        $this->KaryawanMasterModel->updateDataKaryawan($id_karyawan, $dataKaryawan);
      }
      return redirect()->route('karyawan-master')->with('pesan_update_karyawan','Data Berhasil Diubah!');
    }

    public function delete($id_karyawan){
        $this->KaryawanMasterModel->deleteDataKaryawan($id_karyawan);
        return redirect()->route('karyawan-master')->with('pesan_delete_karyawan','Data Berhasil Dihapus!');
    }
}
