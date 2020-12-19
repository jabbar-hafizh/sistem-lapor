@extends('layout.v_template')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-3">
                <h1>Data Laporan Detail</h1>
            </div>
            <div class="col-sm-4">
                @if ($karyawan->status_keluhan == 'Diproses')
                    <span class="btn btn-success" style="cursor: default;">{{ $karyawan->status_keluhan}}</span>
                @elseif ($karyawan->status_keluhan == 'Ditangani')
                    <span class="btn btn-secondary" style="cursor: default;">{{ $karyawan->status_keluhan}}</span>
                @elseif ($karyawan->status_keluhan == 'Sudah Ditangani')
                    <span class="btn btn-danger" style="cursor: default;">{{ $karyawan->status_keluhan}}</span>
                @elseif ($karyawan->status_keluhan == 'Selesai')
                    <span class="btn btn-dark" style="cursor: default;">{{ $karyawan->status_keluhan}}</span>
                @else
                    <td><span class="btn btn-warning" style="cursor: default;">{{ $karyawan->status_keluhan}}</span></td>
                @endif
            </div>
            <div class="col-sm-5">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/karyawan/laporan"><button class="btn btn-dark">Kembali</button></a></li>
                </ol>
            </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
          @php
            $bagian = array('Supervisor Customer Service')
          @endphp
          @if(in_array(session()->get('bagian'), $bagian))
            {{-- jika belum ada penyelesaian --}}
            @if ($karyawan->penyelesaian_keluhan === null)
                <form action="/karyawan/laporan/laporandetilbb/updatepetugas/{{$karyawan->id_keluhan}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bukti Foto Keluhan</label>
                        <div class="filtr-item col-sm-9" data-category="1" data-sort="white sample">
                            <a href="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" data-toggle="lightbox" data-title="Bukti Foto Keluhan">
                                <img src="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keluhan</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_keluhan}}">
                        </div>
                        <label class="col-sm-3 col-form-label">Penjelasan Keluhan</label>
                        <div class="col-sm-9">
                            <textarea rows="5" type="text" readonly class="form-control-plaintext" value="{{$karyawan->penjelasan_keluhan}}">{{$karyawan->penjelasan_keluhan}}</textarea>
                        </div>
                        <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_pengeluh}}">
                        </div>
                        <label class="col-sm-3 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->waktu_keluhan}}">
                        </div>
                        <label class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->no_telp}}">
                        </div>
                        <label class="col-sm-3 col-form-label">Karyawan Petugas</label>
                        <div class="col-sm-9">
                          <select class="form-control select2" @error('id_karyawan') is-invalid @enderror style="width: 100%;" name="id_karyawan">
                          <option value="{{$karyawan->id_karyawan}}">{{$karyawan->nm_karyawan}}</option>
                            @foreach ($karyawan2 as $data)
                              @if (old('id_karyawan') === $data->id_karyawan)
                                  <option value="{{ $data->id_karyawan }}" selected>{{ $data->nm_karyawan }}</option>
                              @else
                                  <option value="{{ $data->id_karyawan }}">{{ $data->nm_karyawan }}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary">Submit Petugas</button>
                        </div>
                    </div>
                </form>
            @endif
          @endif

            {{-- jika sudah ada penyelesaian dan ingin merubah status menjadi selesai --}}
            @if(in_array(session()->get('bagian'), $bagian))
              @if ($karyawan->penyelesaian_keluhan !== null)
                  <form action="/karyawan/laporan/laporandetilbb/selesai/{{$karyawan->id_keluhan}}" method="POST" enctype="multipart/form-data">
                      @method('PUT')
                      @csrf
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bukti Foto Keluhan</label>
                          <div class="filtr-item col-sm-9" data-category="1" data-sort="white sample">
                              <a href="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" data-toggle="lightbox" data-title="Bukti Foto Keluhan">
                                  <img src="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" class="img-fluid mb-2" alt="white sample"/>
                              </a>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Keluhan</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_keluhan}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Penjelasan Keluhan</label>
                          <div class="col-sm-9">
                              <textarea rows="5" type="text" readonly class="form-control-plaintext" value="{{$karyawan->penjelasan_keluhan}}">{{$karyawan->penjelasan_keluhan}}</textarea>
                          </div>
                          <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_pengeluh}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Waktu</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->waktu_keluhan}}">
                          </div>
                          <label class="col-sm-3 col-form-label">No. Telepon</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->no_telp}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Karyawan Petugas</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_karyawan}}">
                          </div>
                          @if ($karyawan->penyelesaian_keluhan !== null)
                              <label class="col-sm-3 col-form-label">Penyelesaian</label>
                              <div class="col-sm-9">
                                  <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->penyelesaian_keluhan}}">
                              </div>
                          @endif
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-12">
                              <button class="btn btn-dark">Selesai</button>
                          </div>
                      </div>
                  </form>
              @endif
            @endif

            {{-- diproses ditangani --}}
            @if(!in_array(session()->get('bagian'), $bagian))
                {{-- dan jika statusnya adalah diproses --}}
                @if ($karyawan->status_keluhan == 'Diproses')
                    <form action="/karyawan/laporan/laporandetilbb/ditangani/{{$karyawan->id_keluhan}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bukti Foto Keluhan</label>
                            <div class="filtr-item col-sm-9" data-category="1" data-sort="white sample">
                                <a href="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" data-toggle="lightbox" data-title="Bukti Foto Keluhan">
                                    <img src="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" class="img-fluid mb-2" alt="white sample"/>
                                </a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keluhan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_keluhan}}">
                            </div>
                            <label class="col-sm-3 col-form-label">Penjelasan Keluhan</label>
                            <div class="col-sm-9">
                                <textarea rows="5" type="text" readonly class="form-control-plaintext" value="{{$karyawan->penjelasan_keluhan}}">{{$karyawan->penjelasan_keluhan}}</textarea>
                            </div>
                            <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_pengeluh}}">
                            </div>
                            <label class="col-sm-3 col-form-label">Waktu</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->waktu_keluhan}}">
                            </div>
                            <label class="col-sm-3 col-form-label">No. Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->no_telp}}">
                            </div>
                            <label class="col-sm-3 col-form-label">Karyawan Petugas</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_karyawan}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button class="btn btn-info">Tangani</button>
                            </div>
                        </div>
                    </form>
                @endif
            @endif

            {{-- ditangani sudah ditangani --}}
            {{-- dan jika statusnya adalah ditangani --}}
            @if(!in_array(session()->get('bagian'), $bagian))
              @if ($karyawan->status_keluhan == 'Ditangani')
                  <form action="/karyawan/laporan/laporandetilbb/sudah-ditangani/{{$karyawan->id_keluhan}}" method="POST" enctype="multipart/form-data">
                      @method('PUT')
                      @csrf
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bukti Foto Keluhan</label>
                          <div class="filtr-item col-sm-9" data-category="1" data-sort="white sample">
                              <a href="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" data-toggle="lightbox" data-title="Bukti Foto Keluhan">
                                  <img src="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" class="img-fluid mb-2" alt="white sample"/>
                              </a>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Keluhan</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_keluhan}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Penjelasan Keluhan</label>
                          <div class="col-sm-9">
                              <textarea rows="5" type="text" readonly class="form-control-plaintext" value="{{$karyawan->penjelasan_keluhan}}">{{$karyawan->penjelasan_keluhan}}</textarea>
                          </div>
                          <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_pengeluh}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Waktu</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->waktu_keluhan}}">
                          </div>
                          <label class="col-sm-3 col-form-label">No. Telepon</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->no_telp}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Karyawan Petugas</label>
                          <div class="col-sm-9">
                              <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_karyawan}}">
                          </div>
                          <label class="col-sm-3 col-form-label">Penyelesaian</label>
                          <div class="col-sm-9">
                              <textarea required name="penyelesaian_keluhan" placeholder="Masukkan penyelesaian" class="form-control" id="" rows="5"></textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-12">
                              <button class="btn btn-danger">Sudah Ditangani</button>
                          </div>
                      </div>
                  </form>
              @endif
            @endif

            {{-- Selesai --}}
            @if(!in_array(session()->get('bagian'), $bagian))
              @if ($karyawan->status_keluhan == 'Selesai')
                <form action="" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bukti Foto Keluhan</label>
                        <div class="filtr-item col-sm-9" data-category="1" data-sort="white sample">
                            <a href="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" data-toggle="lightbox" data-title="Bukti Foto Keluhan">
                                <img src="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keluhan</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_keluhan}}">
                        </div>
                        <label class="col-sm-3 col-form-label">Penjelasan Keluhan</label>
                        <div class="col-sm-9">
                            <textarea rows="5" type="text" readonly class="form-control-plaintext" value="{{$karyawan->penjelasan_keluhan}}">{{$karyawan->penjelasan_keluhan}}</textarea>
                        </div>
                        <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_pengeluh}}">
                        </div>
                        <label class="col-sm-3 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->waktu_keluhan}}">
                        </div>
                        <label class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->no_telp}}">
                        </div>
                        <label class="col-sm-3 col-form-label">Karyawan Petugas</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->nm_karyawan}}">
                        </div>
                        @if ($karyawan->penyelesaian_keluhan !== null)
                            <label class="col-sm-3 col-form-label">Penyelesaian</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{$karyawan->penyelesaian_keluhan}}">
                            </div>
                        @endif
                    </div>
                </form>
              @endif
            @endif
        </div>
      </div>
    </section>
  </div>
@endsection
