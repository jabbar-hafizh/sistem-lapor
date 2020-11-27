@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Laporan Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/karyawan/laporan"><button class="btn btn-dark">Kembali</button></a></li>
                </ol>
            </div>    
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <img src="" class="img-fluid" alt="Responsive image">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pelapor</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_pengeluh}}">
                        <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->id_karyawan_fk}}">
                        <select class="form-control select2 @error('id_karyawan') is-invalid @enderror" style="width: 100%;" name="id_jenis_keluhan_fk">
                            <option></option>
                            @foreach ($karyawan2 as $data)
                            @if (old('id_karyawan') == $data->id_karyawan)
                                <option value="{{ $data->id_karyawan }}" selected>{{ $data->nm_karyawan }}</option>
                            @else
                                <option value="{{ $data->id_karyawan }}">{{ $data->nm_karyawan }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{ $admin->judul_report }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{ $admin->deskripsi_report }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{ $admin->phone_user }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{ $admin->email_user  }}">
                    </div>
                </div> --}}
            </form>
        </div>
      </div>
    </section>
  </div>
@endsection
