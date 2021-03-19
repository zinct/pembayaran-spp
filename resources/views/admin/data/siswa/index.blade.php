@extends('layout/admin')
@section('header')
  <h1>Data Siswa</h1>  
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
              <th>NISN</th>
              <th>NIS</th>
              <th>Kelas</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($siswa as $row)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-left">{{ $row->nama }}</td>
                <td class="text-left">{{ $row->nisn }}</td>
                <td class="text-left">{{ $row->nis }}</td>
                <td class="text-left">{{ $row->kelas_id }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown">Detail</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="https://demospp.isengoding.my.id/siswa/86/edit"><i class="fas fa-edit"></i> Edit</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-trash"></i> Delete</a></li>
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