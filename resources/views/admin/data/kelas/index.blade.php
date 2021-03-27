@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Data Kelas</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Data Kelas</div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-header iseng-sticky bg-white">
      <h4>Data Kelas</h4>
      <div class="card-header-action">
        <a href="javascript:void(0)" onclick="insertData()" data-toggle="modal" data-target="#crud-modal" class="btn btn-primary">Tambah Data</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped dataTable" id="table-1">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama</th>
              <th>Kompetensi</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kelas as $row)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-left">{{ $row->nama }}</td>
                <td class="text-left">{{ $row->kompetensi->nama }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown">Detail</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:void(0)" onclick="updateData({{ $row->id }})"><i class="fas fa-edit"></i> Edit</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0)" onclick="deleteData({{ $row->id }})" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i> Delete</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <!-- CRUD Modal -->
  <form action="" method="POST" id="crud">
    @csrf
    @method('POST')
    <div class="modal fade" id="crud-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="crud-title">Tambah Kelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="crud-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Ketik Nama" autocomplete="off" autofocus="on" required>
            </div>
            <div class="form-group">
              <label>Kompetensi</label>
              <select type="text" name="kompetensi_id" id="kompetensi_id" class="form-control" required>
                <option value="">Pilih Kompetensi</option>
                @foreach ($kompetensi as $row)
                  <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <form action="" method="POST" id="delete-form">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Dihapus?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body text-danger">Data Yang Sudah Dihapus Tidak Bisa Dikembalikan Lagi!</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
            <button class="btn btn-danger" type="submit">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@section('script')
  @include('vendor.izitoast.toast')
  @include('vendor.izitoast.error')

  <script>      
    function insertData() {
      $('#crud input[name="_method"]').val('POST');
      $('#crud-title').html('Tambah Kelas');
      $('#crud').attr('action', '');

      document.getElementById('crud').reset(); 
    }
  
    function updateData(id) {
      $('#crud input[name="_method"]').val('PATCH');
      $('#crud-title').html('Ubah Kelas');
      $('#crud').attr('action', `{{ url('admin/data/kelas/${id}') }}`);
      
      $.ajax({
        url: `{{ url('admin/data/kelas/data/${id}') }}`,
        complete: function() {
          $('#crud-modal').modal('show')
        },
        success: function(data) {
          $('#nama').val(data.nama);
          $('#kompetensi_id').val(data.kompetensi_id);
        }
      });
    }
  
    function deleteData(id) {
      $('#delete-form').attr('action', `{{ url('admin/data/kelas/${id}') }}`);
    }
  </script>
@endsection