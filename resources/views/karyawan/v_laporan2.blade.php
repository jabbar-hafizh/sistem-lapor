@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Laporan Diproses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <div class="user-panel d-flex">
                    <div class="image">
                      <img src="{{asset('img')}}/admin.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                      <a href="/profiladmin" class="d-block">Alexa Pierce</a>
                    </div>
                  </div>
                </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">Data Laporan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div> --}}
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Keluhan</th>
                <th>Waktu</th>
                <th>Karyawan Petugas</th>
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
                    <td>{{ $data->nm_karyawan}}</td>
                    <td><span class="btn btn-success" style="cursor: default;">{{ $data->status_keluhan}}</span></td>
                    <td>
                      <a href=""><button class="btn btn-primary">Detail</button></a>
                    </td>
                    
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
