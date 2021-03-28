@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.data.siswa.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Identitas</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.data.siswa.index') }}">Data Siswa</a></div>
    <div class="breadcrumb-item">Identitas</div>
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
          <form action="{{ route('admin.setting.identitas.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
              <div class="col-8">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Sekolah</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" name="nama_sekolah" value="{{ Helper::nullReplace(@$identitas['nama_sekolah'], '') }}" placeholder="ketik nama sekolah">
                    @error('nama_sekolah')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Provinsi</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" value="{{ Helper::nullReplace(@$identitas['provinsi'], '') }}" placeholder="ketik Provinsi">
                    @error('provinsi')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kota / Kabupaten</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ Helper::nullReplace(@$identitas['kota'], '') }}" placeholder="ketik Provinsi">
                    @error('kota')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telp</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ Helper::nullReplace(@$identitas['telp'], '') }}" placeholder="ketik Telp">
                    @error('telp')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Helper::nullReplace(@$identitas['email'], '') }}" placeholder="ketik Email">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Website</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ Helper::nullReplace(@$identitas['website'], '') }}" placeholder="ketik Website">
                    @error('website')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" data-height="100" placeholder="Ketik Alamat">{{ Helper::nullReplace(@$identitas['alamat'], '') }}</textarea>
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
                    <input type="file" class="dropify" name="logo_sekolah" data-default-file="{{ (@$identitas['logo_sekolah']) ? url('assets/img/identitas/' . $identitas['logo_sekolah']) : url('assets/img/default/identitas.png')  }}" data-show-remove="false" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M" />
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
  @include('vendor.izitoast.error')

  
  <script src="{{ url('assets/vendor/dropify/dropify.js') }}"></script>
  <script>
    $('.dropify').dropify();
  </script>
@endsection