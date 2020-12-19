@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lapor</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('pesan_keluhan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i></h5>
                {{session('pesan_keluhan')}}
            </div>
            @endif
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Form Laporan</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form action="insertkeluhan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNama">Nama</label>
                                    <input type="text" class="form-control" @error('nm_pengeluh') is-invalid @enderror name="nm_pengeluh" id="inputNama" placeholder="Masukkan Nama Anda" value="{{old('nm_pengeluh')}}">
                                    <div class="text-danger">
                                        @error('nm_pengeluh')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNoTelp">No. Telpon</label>
                                    <input type="text" class="form-control" @error('no_telp') is-invalid @enderror name="no_telp" id="inputNoTelp" placeholder="Masukkan Nomor Telpon Anda" value="{{old('no_telp')}}">
                                    <div class="text-danger">
                                        @error('no_telp')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Keluhan</label>
                                    <select class="form-control select2" @error('id_jenis_keluhan_fk') is-invalid @enderror style="width: 100%;" name="id_jenis_keluhan_fk">
                                        <option disabled selected>Silahkan pilih jenis keluhan</option>
                                        @foreach ($pelapor as $data)
                                        @if (old('id_jenis_keluhan_fk') == $data->id_jenis_keluhan)
                                            <option value="{{ $data->id_jenis_keluhan }}" selected>{{ $data->nm_keluhan }}</option>
                                        @else
                                            <option value="{{ $data->id_jenis_keluhan }}">{{ $data->nm_keluhan }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('id_jenis_keluhan_fk')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPenjelasan">Penjelasan</label>
                                    <textarea rows="5" type="text" class="form-control" @error('penjelasan_keluhan') is-invalid @enderror name="penjelasan_keluhan" id="inputPenjelasan" placeholder="Deskripsikan Penjelasan" value="{{old('penjelasan_keluhan')}}">{{old('penjelasan_keluhan')}}</textarea>
                                    <div class="text-danger">
                                        @error('penjelasan_keluhan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="buktiFoto">Bukti Foto</label>
                                    <input type="file" class="form-control-file" @error('bukti_foto_keluhan') is-invalid @enderror name="bukti_foto_keluhan" id="buktiFoto">
                                    <div class="text-danger">
                                        @error('bukti_foto_keluhan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
