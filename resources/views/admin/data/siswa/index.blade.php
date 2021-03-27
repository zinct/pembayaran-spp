@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Data Siswa</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Data Siswa</div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-header iseng-sticky bg-white">
      <h4>Data Siswa</h4>
      <div class="card-header-action">
        <a href="{{ route('admin.data.siswa.create') }}" class="btn btn-primary">Tambah Data</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped dataTable" id="table-1">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama</th>
              <th>NIS</th>
              <th>Jenis Kelamin</th>
              <th>Kelas</th>
              <th>Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($siswa as $row)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-left">{{ $row->nama }}</td>
                <td class="text-left">{{ $row->nis }}</td>
                <td class="text-left">{{ ($row->kelamin == 'L') ? 'Laki - Laki' : 'Perempuan' }}</td>
                <td class="text-left">{{ $row->kelas->nama }}</td>
                <td class="text-left"><div class="badge badge-sm {{ $row->status == 'Aktif' ? 'badge-success' : 'badge-secondary' }}">{{ $row->status }}</div></td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown">Detail</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.data.siswa.show', $row->id) }}"><i class="fas fa-eye"></i> Detail</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.data.siswa.edit', $row->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
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

  <script>
    function deleteData(id) {
      $('#delete-form').attr('action', `{{ url('admin/data/siswa/${id}') }}`);
    }
  </script>
@endsection