@php
  $bagian = array('Customer Service', 'Supervisor Customer Service')
@endphp
@if(!in_array(session()->get('bagian'), $bagian))
<script>window.location = "/dashboard";</script>
@else
  @extends('layout.v_template')

  @section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            @if (session('pesan_update_karyawan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i></h5>
                {{session('pesan_update_karyawan')}}
            </div>
            @endif
            @if (session('pesan_delete_karyawan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i></h5>
                {{session('pesan_delete_karyawan')}}
            </div>
            @endif
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Data Karyawan</h1>
              </div><br><br>
              <div class="col-sm-9 right">
                <a href="/karyawan-master/add"><button type="button" class="btn btn-primary">Tambah Data Karyawan</button></a>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">

          <!-- Default box -->
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Bagian</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($karyawan_m as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->id_karyawan}}</td>
                            <td>{{ $data->nm_karyawan}}</td>
                            <td>{{ $data->alamat}}</td>
                            <td>{{ $data->no_telp}}</td>
                            <td>{{ $data->nm_bagian}}</td>
                            <td>
                                <a href="/karyawan-master/edit/{{$data->id_karyawan}}"><button class="btn btn-info">Ubah</button></a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$data->id_karyawan}}">
                                  Hapus
                                </button>
                            </td>
                        </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.content -->
      </div>

    @foreach ($karyawan_m as $data)
      <div class="modal fade" id="delete{{$data->id_karyawan}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda Yakin Ingin Menghapus Data Karyawan Dengan Nama <strong>{{$data->nm_karyawan}}</strong> dan ID <strong>{{$data->id_karyawan}}</strong>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-info" data-dismiss="modal">Tidak</button>
              <a href="/karyawan-master/delete{{$data->id_karyawan}}" type="button" class="btn btn-danger">Ya</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @endforeach
  @endsection
@endif