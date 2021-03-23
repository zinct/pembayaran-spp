@extends('layout/admin')

@section('header')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Role</h1>
  </div>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('admin.user-manager.role.update', $role->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $role->nama) }}" placeholder="ex. Admin, Petugas">
              @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Permission</label>
            <div class="col-sm-12 col-md-7">
              @if (count($transaksi_permission))
                <label class="font-weight-bold mb-0 mt-2">Transaksi</label>
                @foreach ($transaksi_permission as $row)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $row->id }}" id="{{ $row->id }}" @if($role->permissions->contains($row->id)) checked @endif>
                    <label class="form-check-label" for="{{ $row->id }}">{{ ucwords(ucwords(explode('.', $row->nama)[1])) }}</label>
                  </div>
                @endforeach
              @endif

              @if (count($data_permission))
                <label class="font-weight-bold mb-0 mt-3">Data</label>
                @foreach ($data_permission as $row)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $row->id }}" id="{{ $row->id }}" @if($role->permissions->contains($row->id)) checked @endif>
                    <label class="form-check-label" for="{{ $row->id }}">{{ ucwords(ucwords(explode('.', $row->nama)[1])) }}</label>
                  </div>
                @endforeach
              @endif

              @if (count($laporan_permission))
                <label class="font-weight-bold mb-0 mt-3">Laporan</label>
                @foreach ($laporan_permission as $row)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $row->id }}" id="{{ $row->id }}" @if($role->permissions->contains($row->id)) checked @endif>
                    <label class="form-check-label" for="{{ $row->id }}">{{ ucwords(ucwords(explode('.', $row->nama)[1])) }}</label>
                  </div>
                @endforeach
              @endif

              @if (count($usermanager_permission))
                <label class="font-weight-bold mb-0 mt-3">User Manager</label>
                @foreach ($usermanager_permission as $row)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $row->id }}" id="{{ $row->id }}" @if($role->permissions->contains($row->id)) checked @endif>
                    <label class="form-check-label" for="{{ $row->id }}">{{ ucwords(ucwords(explode('.', $row->nama)[1])) }}</label>
                  </div>
                @endforeach
              @endif

              @if (count($setting_permission))
                <label class="font-weight-bold mb-0 mt-3">Setting</label>
                @foreach ($setting_permission as $row)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $row->id }}" id="{{ $row->id }}" @if($role->permissions->contains($row->id)) checked @endif>
                    <label class="form-check-label" for="{{ $row->id }}">{{ ucwords(ucwords(explode('.', $row->nama)[1])) }}</label>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection