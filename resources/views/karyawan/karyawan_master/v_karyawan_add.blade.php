@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        @if (session('pesan_add_karyawan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i></h5>
            {{session('pesan_add_karyawan')}}
        </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Karyawan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/karyawan-master"><button class="btn btn-dark">Kembali</button></a></li>
                </ol>
            </div>  
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
            <form action="/karyawan-master/insert" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                                function random_string() {
                                    $character_set_array = array();
                                    $character_set_array[] = array('count' => 4, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                    $character_set_array[] = array('count' => 4, 'characters' => '0123456789');
                                    $temp_array = array();
                                    foreach ($character_set_array as $character_set) {
                                        for ($i = 0; $i < $character_set['count']; $i++) {
                                            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
                                        }
                                    }
                                    // shuffle($temp_array);
                                    return implode('', $temp_array);
                                }
                                $random = random_string();
                            ?>
                            <label class="col-form-label">ID Karyawan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="" value="<?php echo $random;?>" readonly
                                @error('id_karyawan') is-invalid @enderror" name="id_karyawan" id="" value="{{old('id_karyawan')}}">
                              </div>
                            <div class="text-danger">
                                @error('id_karyawan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="" @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
                            <div class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="" @error('nm_karyawan') is-invalid @enderror" name="nm_karyawan" value="{{old('nm_karyawan')}}">
                            <div class="text-danger">
                                @error('nm_karyawan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="" @error('no_telp') is-invalid @enderror" name="no_telp" value="{{old('no_telp')}}">
                            <div class="text-danger">
                                @error('no_telp')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Bagian</label>
                            <select class="form-control select2 @error('kd_bagian_fk') is-invalid @enderror" style="width: 100%;" name="kd_bagian_fk">
                                <option></option>
                                @foreach ($karyawan_m as $data)
                                @if (old('kd_bagian_fk') == $data->kd_bagian)
                                    <option value="{{ $data->kd_bagian }}" selected>{{ $data->nm_bagian }}</option>
                                @else
                                    <option value="{{ $data->kd_bagian }}">{{ $data->nm_bagian }}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('kd_bagian_fk')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Alamat</label>
                            <textarea class="form-control" id="" rows="8" @error('alamat') is-invalid @enderror" name="alamat" value="{{old('alamat')}}">{{old('alamat')}}</textarea>
                            <div class="text-danger">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
@endsection