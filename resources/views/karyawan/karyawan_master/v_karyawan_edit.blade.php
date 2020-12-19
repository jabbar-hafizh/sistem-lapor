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
                <h1>Ubah Data Karyawan</h1>
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
            <form action="/karyawan-master/update/{{$karyawan_m->id_karyawan}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">ID Karyawan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="" value="{{$karyawan_m->id_karyawan}}" readonly name="id_karyawan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="" @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Kosongkan jika tidak ingin ubah password">
                            <div class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="" @error('nm_karyawan') is-invalid @enderror" name="nm_karyawan" value="{{$karyawan_m->nm_karyawan}}">
                            <div class="text-danger">
                                @error('nm_karyawan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="" @error('no_telp') is-invalid @enderror" name="no_telp" value="{{$karyawan_m->no_telp}}">
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
                              <option disabled selected>Silahkan pilih bagian</option>
                              @foreach ($karyawan_m2 as $data)
                                <option value="{{ $data->kd_bagian }}" <?php echo $karyawan_m->kd_bagian_fk == $data->kd_bagian ? 'selected' : '' ?>>{{ $data->nm_bagian }}</option>
                              @endforeach
                            </select>
                            <div class="text-danger">
                              @error('kd_bagian_fk')
                                {{ $message }}
                              @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Shift</label>
                            <select class="form-control select2" @error('shift') is-invalid @enderror style="width: 100%;" name="shift">
                              <option disabled selected>Silahkan pilih Shift</option>
                              <option value="1" <?php echo $karyawan_m->shift == 1 ? 'selected' : '' ?>>1</option>
                              <option value="2" <?php echo $karyawan_m->shift == 2 ? 'selected' : '' ?>>2</option>
                              <option value="3" <?php echo $karyawan_m->shift == 3 ? 'selected' : '' ?>>3</option>
                            </select>
                            <div class="text-danger">
                                @error('shift')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Alamat</label>
                            <textarea class="form-control" id="" rows="8" @error('alamat') is-invalid @enderror" name="alamat" value="{{$karyawan_m->alamat}}">{{$karyawan_m->alamat}}</textarea>
                            <div class="text-danger">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Ubah</button>
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
