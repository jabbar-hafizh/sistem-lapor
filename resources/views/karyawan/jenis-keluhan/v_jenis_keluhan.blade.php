@php
  $bagian = array('Customer Service', 'Supervisor Customer Service')
@endphp
@if(!in_array(session()->get('bagian'), $bagian))
  <script>window.location = "/dashboard";</script>
@else
  @extends('layout.v_template')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Jenis Keluhan</h1>
          </div><br><br>
          <div class="col-sm-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">
              Tambah Jenis Keluhan
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <table class="display" id="jenis-keluhan-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Bagian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach($dataJenisKeluhan as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->nm_keluhan}}</td>
                  <td>{{ $row->bagian->nm_bagian }}</td>
                  <td>
                    <a class="editJenisKeluhan"
                      data-id_jenis_keluhan="{{ $row->id_jenis_keluhan }}"
                      data-nama="{{ $row->nm_keluhan }}"
                      data-id_bagian=" $row->bagian->kd_bagian">
                      <button class="btn btn-info">Ubah</button>
                    </a>
                    <a
                      class="deleteJenisKeluhan"
                      data-id_jenis_keluhan="{{ $row->id_jenis_keluhan }}"
                      data-nama="{{ $row->nm_keluhan }}"
                      >
                      <button class="btn btn-danger">Hapus</button>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Delete Jenis Keluhan -->
          <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Jenis Keluhan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="delete-warning"></p>
                  <input type="hidden" class="form-control" id="del_id_jenis_keluhan">
                </div>
                <div class="modal-footer">
                  <button type="button" id="btn-delete" class="btn btn-primary">Ya</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Edit Jenis Keluhan -->
          <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Jenis Keluhan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form>
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="id_jenis_keluhan">
                      <label for="jenis_keluhan" class="col-form-label">Jenis Keluhan</label>
                      <input type="text" class="form-control" id="jenis_keluhan">
                    </div>
                    <div class="form-group">
                      <label for="id_bagian">Bagian</label>
                      <select class="form-control js-states select2_bagian" id="id_bagian">
                        @foreach($dataBagian as $row)
                          <option value="{{$row->kd_bagian}}">{{$row->nm_bagian}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btn-edit" class="btn btn-primary">Ya</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Add Jenis Keluhan -->
          <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Jenis Keluhan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="jenis_keluhan" class="col-form-label">Jenis Keluhan</label>
                      <input type="text" class="form-control" id="add_jenis_keluhan">
                    </div>
                    <div class="form-group">
                      <label for="id_bagian">Bagian</label>
                      <select class="form-control js-states select2_bagian" id="add_id_bagian">
                        @foreach($dataBagian as $row)
                          <option value="{{$row->kd_bagian}}">{{$row->nm_bagian}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btn-add" class="btn btn-primary">Ya</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  @endsection
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
  // Jenis Keluhan Data Table
  $('#jenis-keluhan-table').DataTable()

  // Delete Modal
  $('.deleteJenisKeluhan').on('click', function() {
    const idJenisKeluhan = $(this).data('id_jenis_keluhan')
    const namaKeluhan = $(this).data('nama')
    $('#del_id_jenis_keluhan').val(idJenisKeluhan)
    const deleteModal = $('#delete-modal')
    const deleteWarning = $('#delete-warning')
    deleteWarning.text(`Anda yakin ingin menghapus jenis keluhan "${namaKeluhan}"`)
    deleteModal.modal('show')
  })

  // Edit Modal
  $('.editJenisKeluhan').on('click', function() {
    // Dari Data Table
    const idJenisKeluhan = $(this).data('id_jenis_keluhan')
    const namaKeluhan = $(this).data('nama')
    const idBagian = $(this).data('id_bagian')

    // Ke Modal
    $('#id_jenis_keluhan').val(idJenisKeluhan)
    $('#jenis_keluhan').val(namaKeluhan)
    const editModal = $('#edit-modal')
    editModal.modal('show')
  })

  // Edit Process
  $('#btn-edit').on('click', function(e) {
    e.preventDefault()

    const idJenisKeluhan = $('#id_jenis_keluhan').val()
    const jenisKeluhan = $('#jenis_keluhan').val()
    const idBagian = $('#id_bagian').val()

    try {
      if (!idJenisKeluhan || typeof idJenisKeluhan !== 'string') alert('Id Jenis Keluhan tidak boleh string kosong')
      if (!jenisKeluhan || typeof jenisKeluhan !== 'string') alert('Jenis Keluhan tidak boleh string kosong')
      if (!idBagian || typeof idBagian !== 'string') alert('Bagian tidak boleh string kosong')

      $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      })
      // Todo : Kirim data ke server
      $.ajax({
        url: `/jenis-keluhan/${idJenisKeluhan}/update`,
        type: 'PUT',
        dataType: 'json',
        async: true,
        data: {
          id_jenis_keluhan: idJenisKeluhan,
          nama_keluhan: jenisKeluhan,
          kode_bagian: idBagian
        },
        error: function (err) {
          console.error(err)
          return
        },
        success: function (response) {
          console.log(response)
          if (response.status === 200) {
            alert(`Jenis Keluhan berhasil diubah`)
            const editModal = $('#edit-modal')
            editModal.modal('hide')
            location.reload()
          } else alert(`Jenis Keluhan gagal diubah`)
          return
        }
      })
    } catch (err) {
      console.error(err)
      return
    }
  })

  // Add Process
  $('#btn-add').on('click', function(e) {
    e.preventDefault()

    const jenisKeluhan = $('#add_jenis_keluhan').val()
    const idBagian = $('#add_id_bagian').val()

    try {
      if (!jenisKeluhan || typeof jenisKeluhan !== 'string') alert('Jenis Keluhan tidak boleh string kosong')
      if (!idBagian || typeof idBagian !== 'string') alert('Bagian tidak boleh string kosong')

      $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      })

      $.ajax({
        url: `/jenis-keluhan/store`,
        type: 'POST',
        dataType: 'json',
        async: true,
        data: {
          nama_keluhan: jenisKeluhan,
          kode_bagian: idBagian
        },
        error: function (err) {
          console.error(err)
          return
        },
        success: function (response) {
          console.log(response)
          if (response.status === 200) {
            alert(`Jenis Keluhan berhasil disimpan`)
            const addModal = $('#add-modal')
            addModal.modal('hide')
            location.reload()
          } else alert(`Jenis Keluhan gagal disimpan`)
          return
        }
      })
    } catch (err) {
      console.error(err)
      return
    }
  })

  // Delete Process
  $('#btn-delete').on('click', function(e) {
    e.preventDefault()

    const idJenisKeluhan = $('#del_id_jenis_keluhan').val()

    try {
      if (!idJenisKeluhan || typeof idJenisKeluhan !== 'string') alert('Id Jenis Keluhan tidak boleh string kosong')

      $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      })
      $.ajax({
        url: `/jenis-keluhan/${idJenisKeluhan}/delete`,
        type: 'DELETE',
        dataType: 'json',
        async: true,
        data: {},
        error: function (err) {
          console.error(err)
          return
        },
        success: function (response) {
          console.log(response)
          if (response.status === 200) {
            alert(`Jenis Keluhan berhasil dihapus`)
            const deleteModal = $('#delete-modal')
            deleteModal.modal('hide')
            location.reload()
          } else alert(`Jenis Keluhan gagal dihapus`)
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
