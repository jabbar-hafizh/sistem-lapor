@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Laporan</h1>
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
                <th>Judul</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($admin as $data)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama_user}}</td>
                    <td>{{ $data->judul_report}}</td>
                    <td>{{ $data->waktu_report}}</td>
                    <td><button class="btn btn-warning" style="cursor: default;">Baru</button></td>
                    <td>
                    <a href="/detildatalaporan/{{ $data->id_report }}"><button class="btn btn-primary">Detil</button></a>
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
