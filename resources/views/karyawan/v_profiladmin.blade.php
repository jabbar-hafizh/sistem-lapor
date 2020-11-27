@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><button class="btn btn-dark">Kembali</button></a></li>
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
            <form>
              <div class="form-group">
                <p><img src="" width="100px">Foto</p>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" readonly>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password1">
              </div>
              <button type="submit" class="btn btn-primary">Ubah</button>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection
