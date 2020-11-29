@if(session()->get('bagian') !== 'Customer Service' || session()->get('bagian') !== 'Supervisor Customer Service')
  <script>window.location = "/dashboard";</script>
@else
  @extends('layout.v_template')

  @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bagian</h1>
          </div>
          <div class="col-sm-9">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">
              Tambah Bagian
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">Bagian</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div> --}}
        <div class="card-body">
          <table class="display" id="bagian-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach($dataBagian as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->nm_bagian }}</td>
                  <td>
                    <a class="hapusBagian" data-id_bagian="{{ $row->kd_bagian }}"
                      data-nama_bagian="{{ $row->nm_bagian }}">
                      <button class="btn btn-danger">Hapus</button>
                    </a>
                    <a class="editBagian" data-id_bagian="{{ $row->kd_bagian }}"
                      data-nama_bagian="{{ $row->nm_bagian }}">
                      <button class="btn btn-info">Ubah</button>
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
                  <h5 class="modal-title">Bagian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="delete-warning"></p>
                  <input type="hidden" class="form-control" id="del_id_bagian">
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
                  <h5 class="modal-title">Bagian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form>
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="edit_id_bagian">
                      <label for="edit_nama_bagian" class="col-form-label">Bagian</label>
                      <input type="text" class="form-control" id="edit_nama_bagian">
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
                  <h5 class="modal-title">Bagian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="add_nama_bagian" class="col-form-label">Bagian</label>
                      <input type="text" class="form-control" id="add_nama_bagian">
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
  $('#bagian-table').DataTable();

  // Add Process
  $('#btn-add').on('click', function(e) {
    e.preventDefault()

    const namaBagian = $('#add_nama_bagian').val()

    try {
      if (!namaBagian || typeof namaBagian !== 'string') alert('Bagian tidak boleh string kosong')

      $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      })

      $.ajax({
        url: `/bagian/store`,
        type: 'POST',
        dataType: 'json',
        async: true,
        data: {
          nama_bagian: namaBagian
        },
        error: function (err) {
          console.error(err)
          return
        },
        success: function (response) {
          console.log(response)
          if (response.status === 200) {
            alert(`Bagian berhasil disimpan`)
            const addModal = $('#add-modal')
            addModal.modal('hide')
            location.reload()
          } else alert(`Bagian gagal disimpan`)
          return
        }
      })
    } catch (err) {
      console.error(err)
      return
    }
  })

  // Delete Modal
  $('.hapusBagian').on('click', function() {
    const idBagian = $(this).data('id_bagian')
    const namaBagian = $(this).data('nama_bagian')
    $('#del_id_bagian').val(idBagian)
    const deleteModal = $('#delete-modal')
    const deleteWarning = $('#delete-warning')
    deleteWarning.text(`Anda yakin ingin menghapus bagian "${namaBagian}"`)
    deleteModal.modal('show')
  })

  // Edit Modal
  $('.editBagian').on('click', function() {
    // Dari Data Table
    const idBagian = $(this).data('id_bagian')
    const namaBagian = $(this).data('nama_bagian')

    // Ke Modal
    $('#edit_id_bagian').val(idBagian)
    $('#edit_nama_bagian').val(namaBagian)
    const editModal = $('#edit-modal')
    editModal.modal('show')
  })

  // Delete Process
  $('#btn-delete').on('click', function(e) {
    e.preventDefault()

    const idBagian = $('#del_id_bagian').val()

    try {
      if (!idBagian || typeof idBagian !== 'string') alert('Id Bagian tidak boleh string kosong')

      $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      })
      $.ajax({
        url: `/bagian/${idBagian}/delete`,
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
            alert(`Bagian berhasil dihapus`)
            const deleteModal = $('#delete-modal')
            deleteModal.modal('hide')
            location.reload()
          } else alert(`Bagian gagal dihapus`)
          return
        }
      })
    } catch (err) {
      console.error(err)
      return
    }
  })

  // Edit Process
  $('#btn-edit').on('click', function(e) {
    e.preventDefault()

    const idBagian = $('#edit_id_bagian').val()
    const namaBagian = $('#edit_nama_bagian').val()

    try {
      if (!idBagian || typeof idBagian !== 'string') alert('Id bagian tidak boleh string kosong')
      if (!namaBagian || typeof namaBagian !== 'string') alert('Bagian tidak boleh string kosong')

      $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      })
      // Todo : Kirim data ke server
      $.ajax({
        url: `/bagian/${idBagian}/update`,
        type: 'PUT',
        dataType: 'json',
        async: true,
        data: {
          nama_bagian: namaBagian
        },
        error: function (err) {
          console.error(err)
          return
        },
        success: function (response) {
          console.log(response)
          if (response.status === 200) {
            alert(`Bagian berhasil diubah`)
            const editModal = $('#edit-modal')
            editModal.modal('hide')
            location.reload()
          } else alert(`Bagian gagal diubah`)
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
