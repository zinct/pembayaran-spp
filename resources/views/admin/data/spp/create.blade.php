@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.data.spp.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Tambah SPP</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.data.spp.index') }}">SPP</a></div>
    <div class="breadcrumb-item">Tambah SPP</div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.data.spp.store') }}" method="POST">
            @csrf
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pembayaran</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="ketik nama spp">
                @error('nama')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Ajaran</label>
              <div class="col-sm-12 col-md-7">
                <select type="text" name="tahun_id" id="tahun_id" class="form-control" required>
                  <option value="">Pilih Tahun Ajaran</option>
                  @foreach ($tahun as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                  @endforeach
                </select>
                @error('tahun')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tipe Pembayaran</label>
              <div class="col-sm-12 col-md-7">
                <select type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe">
                  <option value="">Pilih Tipe Pembayaran</option>
                  <option value="Bulanan">Bulanan</option>
                  <option value="Bebas">Bebas</option>
                </select>
                @error('tipe')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nominal</label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control numeric @error('nominal') is-invalid @enderror" name="nominal" placeholder="ex. 5.000.000">
                @error('nominal')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pembayaran Untuk</label>
              <div class="col-sm-12 col-md-7">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" onclick="checkAll()" id="all" class="custom-control-input"> 
                  <label for="all" class="custom-control-label">Semua Kelas</label>
                </div>
                @foreach ($kelas as $row)
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="kelas_id[]" value="{{ $row->id }}" id="kelas-{{ $row->id }}" class="custom-control-input">
                    <label for="kelas-{{ $row->id }}" class="custom-control-label">{{ $row->nama }}</label>
                  </div>
                @endforeach
                @error('siswa_id')
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

@section('script')
  <script>
    function checkAll() {
      var checkboxes = document.getElementsByName('kelas_id[]');
      for (var checkbox of checkboxes) {
        checkbox.checked = !checkbox.checked;
      }
    }
  </script>
@endsection