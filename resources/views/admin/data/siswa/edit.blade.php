@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.data.siswa.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Edit Siswa</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.data.siswa.index') }}">Siswa</a></div>
    <div class="breadcrumb-item">Edit Siswa</div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.data.siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIS</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ $siswa->nis }}" placeholder="ketik nis">
                @error('nis')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NISN</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ $siswa->nisn }}" placeholder="ketik nisn">
                @error('nisn')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $siswa->nama }}" placeholder="ketik nama siswa">
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
                  <option value="1">XI RPL 4</option>
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
                  @foreach ($kelamin as $row)
                    @if ($row == $siswa->kelamin)
                      <option value="{{ $row }}" selected>{{ ($row == 'L') ? 'Laki - Laki' : 'Perempuan' }}</option>
                    @else  
                      <option value="{{ $row }}">{{ ($row == 'L') ? 'Laki - Laki' : 'Perempuan' }}</option>
                    @endif
                  @endforeach
                </select>
                @error('kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telp</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ $siswa->telp }}" placeholder="ex. 085321757616">
                @error('telp')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
              <div class="col-sm-12 col-md-7">
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" data-height="100" placeholder="Ketik Alamat">{{ $siswa->alamat }}</textarea>
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
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection