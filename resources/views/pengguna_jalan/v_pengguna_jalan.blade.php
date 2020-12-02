<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Report</title>
    {{-- responsive --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- link css --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- utama --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        {{-- nav bar --}}
        <nav class="main-header navbar navbar-expand bg-navy">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <li class="brand-link" style="letter-spacing: 3px;"><i class="fas"><img class="brand-image img-circle elevation-3" src="{{asset('img')}}/logo-jnk-logo.png" alt=""></i></li>
                    <li class="nav-link" style="letter-spacing: 3px;"><h4>JASAMARGA NGAWI KERTOSONO</h4></li>
                </li>
            </ul>
        </nav>

        {{-- content --}}
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
                            <form action="/pengguna_jalan/insertkeluhan" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputNama">Nama</label>
                                            <input type="text" class="form-control @error('nm_pengeluh') is-invalid @enderror" name="nm_pengeluh" id="inputNama" placeholder="Masukkan Nama Anda" value="{{old('nm_pengeluh')}}">
                                            <div class="text-danger">
                                                @error('nm_pengeluh')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNoTelp">No. Telpon</label>
                                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="inputNoTelp" placeholder="Masukkan Nomor Telpon Anda" value="{{old('no_telp')}}">
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
                                            <select class="form-control select2 @error('id_jenis_keluhan_fk') is-invalid @enderror" style="width: 100%;" name="id_jenis_keluhan_fk">
                                                <option></option>
                                                @foreach ($jenis_keluhan as $data)
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
                                            <textarea rows="5" type="text" class="form-control @error('penjelasan_keluhan') is-invalid @enderror" name="penjelasan_keluhan" id="inputPenjelasan" placeholder="Deskripsikan Penjelasan" value="{{old('penjelasan_keluhan')}}">{{old('penjelasan_keluhan')}}</textarea>
                                            <div class="text-danger">
                                                @error('penjelasan_keluhan')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="buktiFoto">Bukti Foto</label>
                                            <input type="file" class="form-control-file @error('bukti_foto_keluhan') is-invalid @enderror" name="bukti_foto_keluhan" id="buktiFoto">
                                            <div class="text-danger">
                                                @error('bukti_foto_keluhan')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary bg-navy">Kirim</button>
                            </form>
                        </div>            
                    </div>
                </div>
            </section>
        </div>

        {{-- footer --}}
        <footer class="main-footer bg-navy text-center">
            <strong>&copy; 2020</strong>
        </footer> 

        <aside class="control-sidebar control-sidebar-dark">
        {{-- Control sidebar content goes here --}}
        </aside>
    </div>

    {{-- script js --}}
    {{-- utama --}}
    <!-- jQuery -->
    <script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('template')}}/dist/js/demo.js"></script>
</body>
</html>
