@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        @if (session('pesan_update_petugas'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i></h5>
            {{session('pesan_update_petugas')}}
        </div>
        @endif
        @if (session('pesan_selesai_petugas'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i></h5>
            {{session('pesan_selesai_petugas')}}
        </div>
        @endif
        @if (session('pesan_selesai_ditangani_petugas'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i></h5>
            {{session('pesan_selesai_ditangani_petugas')}}
        </div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Laporan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="form-group">
          </div>
          @if(session()->get('bagian') === 'Customer Service' || session()->get('bagian') === 'Supervisor Customer Service')
            <form action="/export" class="form-group">
              @php
                $now = date("Y-m-d");
              @endphp
              <label for=""></label>
              <input name="startdate" type="date" class="btn-sm" value="" min="2020-01-01" max="{{$now}}" required>
              <label for="">-</label>
              <input name="enddate" type="date" class="btn-sm" value="{{$now}}" min="2020-01-01" max="{{$now}}" required>
              <button class="btn btn-sm btn-dark"><i class="fa fa-download"></i></button>
            </form>
          @else
            {{-- @if(session()->get('id_karyawan') === $data->id_karyawan_fk) --}}
            <form action="/export" class="form-group">
              @php
                  $now = date("Y-m-d");
              @endphp
              <label for=""></label>
              <input type="text" readonly class="form-control-plaintext" value="{{session()->get('nama_karyawan')}}" hidden name="namakaryawan">
              <input name="startdate" type="date" class="btn-sm" value="" min="2020-01-01" max="{{$now}}" required>
              <label for="">-</label>
              <input name="enddate" type="date" class="btn-sm" value="{{$now}}" min="2020-01-01" max="{{$now}}" required>
              <button class="btn btn-sm btn-dark"><i class="fa fa-download"></i></button>
            </form>
            {{-- @endif --}}
          @endif
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Pelapor</th>
                <th>Keluhan</th>
                <th>Waktu</th>
                <th>Penanggung Jawab</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($karyawan as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->nm_pengeluh}}</td>
                  <td>{{ $data->nm_keluhan}}</td>
                  <td>{{ $data->waktu_keluhan}}</td>
                  <td>
                    @if ($data->nm_karyawan)
                      {{ $data->nm_karyawan}}
                    @else
                      -
                    @endif
                  </td>
                  @if ($data->status_keluhan == 'Baru')
                    <td><span class="btn btn-warning" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                    <td>
                      <a href="/karyawan/laporan/laporandetil/{{$data->id_keluhan}}"><button class="btn btn-primary">Detail</button></a>
                    </td>
                  @elseif ($data->status_keluhan == 'Diproses')
                    <td><span class="btn btn-success" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                    <td>
                      @if(session()->get('bagian') === 'Customer Service' || session()->get('bagian') === 'Supervisor Customer Service')
                      <a href="/karyawan/laporan/laporandetilbb/{{$data->id_keluhan}}"><button class="btn btn-primary" disabled>Detail</button></a>
                      @else
                      <a href="/karyawan/laporan/laporandetilbb/{{$data->id_keluhan}}"><button class="btn btn-primary">Detail</button></a>
                      @endif
                    </td>
                  @elseif ($data->status_keluhan == 'Ditangani')
                    <td><span class="btn btn-secondary" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                    <td>
                      <a href="/karyawan/laporan/laporandetilbb/{{$data->id_keluhan}}"><button class="btn btn-primary">Detail</button></a>
                    </td>
                  @elseif ($data->status_keluhan == 'Sudah Ditangani')
                    <td><span class="btn btn-danger" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                    <td>
                      <a href="/karyawan/laporan/laporandetilbb/{{$data->id_keluhan}}"><button class="btn btn-primary">Detail</button></a>
                    </td>
                  @elseif ($data->status_keluhan == 'Selesai')
                    <td><span class="btn btn-dark" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                    <td>
                      <a href="/karyawan/laporan/laporandetilbb/{{$data->id_keluhan}}"><button class="btn btn-primary">Detail</button></a>
                    </td>
                  @else
                    <td><span class="btn btn-warning" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
@endsection
