@if(session()->get('bagian') !== 'Customer Service' || session()->get('bagian') !== 'Supervisor Customer Service')
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
          @endif
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Karyawan</h1>
            </div><br><br>
            <div class="col-sm-9 right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data Karyawan</button>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

<<<<<<< HEAD
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
=======
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
                              <a href=""><button class="btn btn-info">Ubah</button></a>
                              <a href=""><button class="btn btn-danger">Hapus</button></a>
                          </td>
                      </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
>>>>>>> ec69d993f05b961b15d46f724e3676a14ae02c96
        </div>
        <!-- /.card -->
      </section>
      <!-- /.content -->
  </div>

<<<<<<< HEAD
@foreach ($karyawan_m as $data)
  <div class="modal fade" id="delete{{$data->id_karyawan}}">
    <div class="modal-dialog">
      <div class="modal-content bg-dark">
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
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/karyawan-master/delete{{$data->id_karyawan}}" type="button" class="btn btn-outline-light">Ya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach

@endsection


=======

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Data Karyawan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
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
                                  <input type="text" class="form-control" id="" value="<?php echo $random;?>" readonly
                                      @error('id_karyawan') is-invalid @enderror" name="id_karyawan" id="" value="{{old('id_karyawan')}}">
                                  <div class="text-danger">
                                      @error('id_karyawan')
                                          {{ $message }}
                                      @enderror
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-form-label">Password</label>
                                  <input type="text" class="form-control" id="" @error('nm_karyawan') is-invalid @enderror" name="nm_karyawan" id="" value="{{old('nm_karyawan')}}">
                                  <div class="text-danger">
                                      @error('nm_karyawan')
                                          {{ $message }}
                                      @enderror
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-form-label">Nama Karyawan</label>
                                  <input type="text" class="form-control" id="">
                              </div>
                              <div class="form-group">
                                  <label class="col-form-label">Nomor Telepon</label>
                                  <input type="text" class="form-control" id="">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="col-form-label">Bagian</label>
                                  <select name="" id="" class="form-control">
                                      <option value=""></option>
                                      @foreach ($karyawan_m as $data)
                                      <option value="{{$data->kd_bagian}}">{{$data->nm_bagian}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label class="col-form-label">Alamat</label>
                                  <textarea class="form-control" id="" rows="8"></textarea>
                              </div>
                          </div>
                     </div>
                     <div class="modal-footer">
                      <button type="button" class="btn btn-primary">Tambah</button>

                     </div>
                     {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> --}}
                  </form>
              </div>
          </div>
      </div>
  </div>

  <script>
      $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('New message to ' + recipient)
          modal.find('.modal-body input').val(recipient)
      })
  </script>

  @endsection
@endif
>>>>>>> ec69d993f05b961b15d46f724e3676a14ae02c96
