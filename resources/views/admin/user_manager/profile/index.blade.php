@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Data Profile</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Data Profile</div>
  </div>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ url('assets/vendor/dropify/dropify.css') }}">
@endsection

@section('content')
<form action="{{ route('admin.user-manager.profile.update', $user->id) }}" enctype="multipart/form-data" method="POST">
  @csrf
  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <input type="file" class="dropify" name="avatar" data-default-file="{{ url('assets/img/avatars/' . Helper::nullReplace($user->avatar, 'default.png')) }}" data-show-remove="false" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M" />
          <div class="user-item">
              <div class="user-details">
                <div class="user-name">{{ $user->nama }}</div>
                <div class="text-job text-muted">{{ $user->role->nama }}</div>
                <div class="user-cta">
                </div>
              </div>  
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="profile">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="ketik nama">
                  @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" placeholder="ketik username">
                  @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Lama</label>
                <div class="col-sm-12 col-md-7">
                  <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Kosongkan jika tidak diubah">
                  @error('old_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ganti Password</label>
                <div class="col-sm-12 col-md-7">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Ganti Password">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
                <div class="col-sm-12 col-md-7">
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Password">
                  @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <a href="{{ route('admin.user-manager.profile.delete-avatar') }}" class="btn btn-danger">Hapus Avatar</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('script')
  @include('vendor.izitoast.toast')
  @include('vendor.izitoast.error')

  
  <script src="{{ url('assets/vendor/dropify/dropify.js') }}"></script>
  <script>
    $('.dropify').dropify();
  </script>
@endsection