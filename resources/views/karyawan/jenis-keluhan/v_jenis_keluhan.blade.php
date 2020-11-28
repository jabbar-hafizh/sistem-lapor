@extends('layout.v_template')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jenis Keluhan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">Jenis Keluhan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div> --}}
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
                      <button class="btn btn-info">Edit</button>
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
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Ya</button>
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
                <div class="modal-body">
                  <form>
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
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="btn-edit" class="btn btn-primary">Ya</button>
                </div>
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
      if (!idJenisKeluhan || idJenisKeluhan !== 'string') alert('Id Jenis Keluhan tidak boleh string kosong')
      if (!jenisKeluhan || jenisKeluhan !== 'string') alert('Jenis Keluhan tidak boleh string kosong')
      if (!idBagian || idBagian !== 'string') alert('Bagian tidak boleh string kosong')

      // Todo : Kirim data ke server
    } catch (err) {
      console.error(err)
      return
    }
  })
})
</script>
