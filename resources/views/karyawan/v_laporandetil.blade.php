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
          <span class="btn btn-warning" style="cursor: default;">{{$karyawan->status_keluhan}}</span>
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
        <form>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Bukti Foto Keluhan</label>
            <div class="filtr-item col-sm-9" data-category="1" data-sort="white sample">
              <a href="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" data-toggle="lightbox" data-title="Bukti Foto Keluhan">
                <img src="{{ url('img/'.$karyawan->bukti_foto_keluhan) }}" class="img-fluid mb-2" alt="white sample"/>
              </a>
            </div>
            <div class="col-sm-9">
              <input type="hidden" readonly class="form-control-plaintext" value="{{$karyawan->id_keluhan}}" id="id_keluhan">
            </div>
          </div>

          <!-- Ringan -->
          <div class="form-group row ringan" id="ringan">
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
            <label class="col-sm-3 col-form-label">Tingkat Keluhan</label>
            <div class="col-sm-9">
              <select class="form-control select2 ringan_tingkat_keluhan" style="width: 100%;" name="ringan_tingkat_keluhan" id="ringan_tingkat_keluhan" required>
              <option disabled selected>Pilih tingkat kesulitan</option>
              <option value="ringan" selected>Ringan</option>
              <option value="berat">Berat</option>
              </select>
            </div>
            <label class="col-sm-3 col-form-label">Penyelesaian</label>
            <div class="col-sm-9">
              <textarea rows="5" type="text" class="form-control" name="ringan_penyelesaian" id="ringan_penyelesaian"></textarea>
            </div>
            <div class="col-sm-9">
              <input type="hidden" readonly class="form-control-plaintext" id="ringan_id_karyawan" name="ringan_id_karyawan" value="{{ session()->get('id_karyawan')}}">
            </div>
            <br>
            <div class="col-sm-12">
              <button class="btn btn-dark btnSelesai" type="button" id="btnSelesai">Selesai</button>
            </div>
          </div>

          <!-- Keluhan Berat -->
          <div class="form-group row berat" id="berat" style="display: none;">
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
            <label class="col-sm-3 col-form-label">Tingkat Keluhan</label>
            <div class="col-sm-9">
              <select class="form-control select2 berat_tingkat_keluhan" style="width: 100%;" name="berat_tingkat_keluhan" id="berat_tingkat_keluhan" required>
              <option disabled selected>Pilih tingkat kesulitan</option>
              <option value="ringan">Ringan</option>
              <option value="berat" selected>Berat</option>
              </select>
            </div>
            <label class="col-sm-3 col-form-label">Petugas</label>
            <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" name="berat_id_karyawan" id="berat_id_karyawan" required>
                <option disabled selected>Pilih petugas</option>
                @foreach ($filterKaryawan as $data)
                  <option value="{{ $data->id_karyawan }}">{{ $data->nm_karyawan}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-12">
              <button class="btn btn-primary btnKirim" type="button" id="btnKirim">Kirim</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    // Filter karyawan petugas berdasarkan tingkat keluhan
    // $('.tingkat_keluhan').on('change', function(e) {
    //   e.preventDefault()
    //   const tingkatKeluhan = $(this).val()
    //   try {
    //     $.ajaxSetup({
    //       headers:
    //       { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    //     })
    //
    //     $.ajax({
    //       url: `/karyawan/laporan/filter-petugas`,
    //       type: 'POST',
    //       dataType: 'json',
    //       async: true,
    //       data: {
    //         tingkat_keluhan: tingkatKeluhan
    //       },
    //       error: function (err) {
    //         console.error(err)
    //         return
    //       },
    //       success: function (response) {
    //         let html = ''
    //         if (response.data.tingkat_keluhan === 'ringan') {
    //           $('#default').css('display','none')
    //           $('#berat').css('display','none')
    //           $('.ringan_tingkat_keluhan option:selected').attr("selected",null);
    //           $('.ringan_tingkat_keluhan option[value="ringan"]').attr("selected","selected");
    //           $('#ringan').show()
    //         } else {
    //           $('#default').css('display','none')
    //           $('#ringan').css('display','none')
    //           $('.berat_tingkat_keluhan option:selected').attr("selected",null);
    //           $('.berat_tingkat_keluhan option[value="berat"]').attr("selected","selected");
    //           $('#berat').show()
    //         }
    //         return
    //       }
    //     })
    //   } catch (error) {
    //     console.error(error)
    //     return
    //   }
    // })
    $('#ringan_tingkat_keluhan').on('change', function(e) {
      e.preventDefault()
      const tingkatKeluhan = $(this).val()
      try {
        $.ajaxSetup({
          headers:
          { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $.ajax({
          url: `/karyawan/laporan/filter-petugas`,
          type: 'POST',
          dataType: 'json',
          async: true,
          data: {
            tingkat_keluhan: tingkatKeluhan
          },
          error: function (err) {
            console.error(err)
            return
          },
          success: function (response) {
            let html = ''
            if (response.data.tingkat_keluhan === 'ringan') {
              $('#default').css('display','none')
              $('#berat').css('display','none')
              $('#ringan_tingkat_keluhan option:selected').attr("selected",null);
              $('#ringan_tingkat_keluhan option[value="ringan"]').attr("selected","selected");
              $('#ringan').show()
            } else {
              $('#default').css('display','none')
              $('#ringan').css('display','none')
              $('#berat_tingkat_keluhan option:selected').attr("selected",null);
              $('#berat_tingkat_keluhan option[value="berat"]').attr("selected","selected");
              $('#berat').show()
            }
            return
          }
        })
      } catch (error) {
        console.error(error)
        return
      }
    })
    $('#berat_tingkat_keluhan').on('change', function(e) {
      e.preventDefault()
      const tingkatKeluhan = $(this).val()
      try {
        $.ajaxSetup({
          headers:
          { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $.ajax({
          url: `/karyawan/laporan/filter-petugas`,
          type: 'POST',
          dataType: 'json',
          async: true,
          data: {
            tingkat_keluhan: tingkatKeluhan
          },
          error: function (err) {
            console.error(err)
            return
          },
          success: function (response) {
            let html = ''
            if (response.data.tingkat_keluhan === 'ringan') {
              $('#default').css('display','none')
              $('#berat').css('display','none')
              $('#ringan_tingkat_keluhan option:selected').attr("selected",null);
              $('#ringan_tingkat_keluhan option[value="ringan"]').attr("selected","selected");
              $('#ringan').show()
            } else {
              $('#default').css('display','none')
              $('#ringan').css('display','none')
              $('#berat_tingkat_keluhan option:selected').attr("selected",null);
              $('#berat_tingkat_keluhan option[value="berat"]').attr("selected","selected");
              $('#berat').show()
            }
            return
          }
        })
      } catch (error) {
        console.error(error)
        return
      }
    })
    $('#btnSelesai').on('click', function(e) {
      e.preventDefault
      const idKeluhan = $('#id_keluhan').val()
      const tingkatKeluhan = $('#ringan_tingkat_keluhan').val()
      const idKaryawan = $('#ringan_id_karyawan').val()
      const penyelesaian = $('#ringan_penyelesaian').val()
      const status = 'Selesai'

      try {
        $.ajaxSetup({
          headers:
          { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $.ajax({
          url: `/karyawan/laporan/ringan/selesai`,
          type: 'PUT',
          dataType: 'json',
          async: true,
          data: {
            tingkat_keluhan: tingkatKeluhan,
            id_keluhan: idKeluhan,
            id_karyawan: idKaryawan,
            penyelesaian,
            status
          },
          error: function (err) {
            console.error(err)
            return
          },
          success: function (response) {
            console.log(response)
            if (response.status === 200) {
              alert(`Keluhan berhasil diselesaikan`)
              // location.reload()
              window.location = '/karyawan/laporan'
            } else alert(`Keluhan gagal disimpan`)
            return
          }
        })
      } catch (error) {
        console.error(error)
        return
      }

    })
    $('#btnKirim').on('click', function(e) {
      e.preventDefault()

      const idKeluhan = $('#id_keluhan').val()
      const tingkatKeluhan = $('#berat_tingkat_keluhan').val()
      const idKaryawan = $('#berat_id_karyawan').val()
      const status = 'Diproses'

      try {
        $.ajaxSetup({
          headers:
          { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        })

        $.ajax({
          url: `/karyawan/laporan/berat/diproses`,
          type: 'PUT',
          dataType: 'json',
          async: true,
          data: {
            tingkat_keluhan: tingkatKeluhan,
            id_keluhan: idKeluhan,
            id_karyawan: idKaryawan,
            status
          },
          error: function (err) {
            console.error(err)
            return
          },
          success: function (response) {
            console.log(response)
            if (response.status === 200) {
              alert(`Keluhan berhasil diproses ke manager`)
              // location.reload()
              window.location = '/karyawan/laporan'
            } else alert(`Keluhan gagal disimpan`)
            return
          }
        })
      } catch (err) {
        console.error(err)
        return
      }
    })
  })
</script>
