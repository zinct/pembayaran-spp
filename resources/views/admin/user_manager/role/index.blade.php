@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Data Permission</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Data Permission</div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-header iseng-sticky bg-white">
      <h4>Data Role</h4>
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
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($role as $row)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-left">{{ $row->nama }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown">Detail</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.user-manager.role.edit', $row->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
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
            <h5 class="modal-title" id="crud-title">Tambah Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="crud-body">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Ketik Nama" autocomplete="off" autofocus="on" required>
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
      $('#crud-title').html('Tambah Role');
      $('#crud').attr('action', '');

      document.getElementById('crud').reset(); 
    }
  
    function deleteData(id) {
      $('#delete-form').attr('action', `{{ url('admin/user-manager/role/${id}') }}`);
    }
  </script>
@endsection