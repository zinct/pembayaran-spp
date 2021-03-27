@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.data.siswa.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Tambah Siswa</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.data.siswa.index') }}">Data Siswa</a></div>
    <div class="breadcrumb-item">Tambah Siswa</div>
  </div>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ url('assets/vendor/dropify/dropify.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.data.siswa.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
              <div class="col-8">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIS</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" placeholder="ketik nis">
                    @error('nis')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NISN</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" placeholder="ketik nisn">
                    @error('nisn')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="ketik nama siswa">
                    @error('nama')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas</label>
                  <div class="col-sm-12 col-md-7">
                    <select type="text" class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                      <option value="">Pilih Kelas</option>
                      @foreach ($kelas as $row)
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                      @endforeach
                    </select>
                    @error('kelas_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                  <div class="col-sm-12 col-md-7">
                    <select type="text" class="form-control @error('kelamin') is-invalid @enderror" name="kelamin">
                      <option value="">Pilih Kelamin</option>
                      <option value="L">Laki - Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                    @error('kelamin')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telp</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" placeholder="ex. 085321757616">
                    @error('telp')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                  <div class="col-sm-12 col-md-7">
                    <select type="text" class="form-control @error('status') is-invalid @enderror" name="status">
                      <option value="">Pilih Status</option>
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                    @error('status')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" data-height="100" placeholder="Ketik Alamat"></textarea>
                    @error('alamat')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group row mb-4">
                  <div class="col-sm-12 col-md-7">
                    <input type="file" class="dropify" name="avatar" data-default-file="{{ url('assets/img/avatars/default.png') }}" data-show-remove="false" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M" />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  @include('vendor.izitoast.toast')

  
  <script src="{{ url('assets/vendor/dropify/dropify.js') }}"></script>
  <script>
    $('.dropify').dropify();
  </script>
@endsection