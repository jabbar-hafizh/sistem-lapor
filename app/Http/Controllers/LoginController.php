<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\KaryawanModel;
use Session;
class LoginController extends Controller {
  public function index() {
    return view('karyawan.login.v_signin');
  }


  public function authenticate(Request $request){
    // Retrive Input

    $credentials = $request->only('id_karyawan', 'password');

    if (Auth::attempt($credentials)) {
      // if success login
      $karyawan = KaryawanModel::findOrFail($request->id_karyawan);
      if (!$karyawan) {
        echo 'id karyawan tidak ada';
        return;
      }
      $request->session()->put('nama_karyawan', $karyawan->nm_karyawan);
      $request->session()->put('id_karyawan', $karyawan->id_karyawan);
      $request->session()->put('bagian', $karyawan->bagian->nm_bagian);
      return redirect('dashboard');
      //return redirect()->intended('/details');
    }

    // if failed login
    // return redirect('/');
  }
}
