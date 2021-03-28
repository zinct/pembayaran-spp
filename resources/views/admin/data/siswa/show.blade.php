@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.data.siswa.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Detail Siswa</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.data.siswa.index') }}">Siswa</a></div>
    <div class="breadcrumb-item">Detail Siswa</div>
  </div>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ url('assets/vendor/dropify/dropify.css') }}">
@endsection

@section('content')
  <div class="card card-primary card-outline">
    <div class="card-body">
      <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Detail</a>
        </li>
        @if ($siswa->status != 'Tidak Aktif')
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tagihan" role="tab" aria-controls="profile" aria-selected="false">Tagihan</a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="contact" aria-selected="false">Riwayat Pembayaran</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel">
          <div class="row">
            <div class="col-md-3">
              <div class="card">
                <div class="card-body box-profile">
                  <input type="file" class="dropify" name="avatar" data-default-file="{{ url('assets/img/siswa/' . Helper::nullReplace($siswa->avatar, 'default.png')) }}" data-show-remove="false" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M" disabled />
                  <div class="user-item">
                      <div class="user-details">
                        <div class="user-name">{{ $siswa->nama }}</div>
                        <div class="text-job text-muted">{{ $siswa->nis }}</div>
                        <div class="badge badge-sm {{ $siswa->status == 'Aktif' ? 'badge-success' : 'badge-secondary' }}">{{ $siswa->status }}</div>
                        <div class="user-cta">
                        </div>
                      </div>  
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NISN</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" value="{{ $siswa->nisn }}"  readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" value="{{ $siswa->kelas->nama }}"  readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kompetensi</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" value="{{ $siswa->kelas->kompetensi->nama }}"  readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" value="{{ $siswa->kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}"  readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telp</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" class="form-control" value="{{ $siswa->telp }}"  readonly>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea class="form-control" data-height="100" readonly>{{ $siswa->alamat }}</textarea>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tagihan" role="tabpanel" aria-labelledby="profile-tab">
          @can('transaksi.tagihan')
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tagihan-modal">Tambah Tagihan</button>
          @endcan
          <div id="accordion">
            @foreach ($siswa->spp as $row)
              <div class="accordion">
                <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-{{ $row->id }}">
                  <div class="d-flex justify-content-between">
                    <h4>{{ $row->nama }}</h4>
                    <h4>{{ $row->tahun->nama }}</h4>
                  </div>
                </div>
                <div class="accordion-body collapse" id="panel-body-{{ $row->id }}" data-parent="#accordion">
                  <div class="row">
                    @for ($i = 1; $i <= 12; $i++)
                      <div class="col-4">
                        <div class="card">
                          <div class="card-body px-0">
                            <h6>Rp. {{ number_format($row->nominal / 12) }}</h6>
                            <span>{{ Helper::getMonth($i) }}</span>
                          </div>
                          @php
                          $bulan_sekarang = DB::table('v_tagihan')->find($row->pivot->id)->bulan_ke;
                          @endphp
                          @if ($bulan_sekarang >= $i)
                            <button type="button" class="btn btn-sm btn-success" style="width: 100%">Lunas</button>
                          @else
                            <button type="button" class="btn btn-sm btn-secondary" style="width: 100%">Belum Lunas</button>
                          @endif
                        </div>
                      </div>
                    @endfor
                  </div>
                  @can('transaksi.tagihan')
                    <button onclick="deleteData({{ $row->id }}, {{ $siswa->id }})" data-toggle="modal" data-target="#delete-modal" class="btn btn-sm btn-danger float-right mb-3"><i class="fas fa-trash"></i></button>
                  @endcan
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="contact-tab">...</div>
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <form action="{{ route('admin.transaksi.tagihan.store', $siswa->id) }}" method="POST">
    @csrf
    <div class="modal fade" id="tagihan-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Tambah Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                @foreach ($spp as $row)
                  <div class="custom-control custom-checkbox py-1">
                    <input type="checkbox" class="custom-control-input" name="spp_id[]" id="{{ $row->id }}" value="{{ $row->id }}" {{ ($siswa->spp->contains($row->id)) ? 'checked disabled' : '' }}>
                    <label class="custom-control-label d-flex justify-content-between" for="{{ $row->id }}">
                      <span><b>{{ $row->nama }}</b> ({{ $row->tipe }})</span>
                      <span class="text-right"><span>{{ number_format($row->nominal) }}</span>
                    </label>
                  </div>
                @endforeach
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
  
  <script src="{{ url('assets/vendor/dropify/dropify.js') }}"></script>
  <script>
    $('.dropify').dropify();

    function deleteData(id, siswa_id) {
      $('#delete-form').attr('action', `{{ url('admin/transaksi/tagihan/${id}/${siswa_id}') }}`);
    }
  </script>
@endsection