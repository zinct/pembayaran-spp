@extends('layout.siswa', compact('siswa', 'identitas'))

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
          <div id="accordion">
            @forelse ($siswa->spp as $row)
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
                </div>
              </div>
            @empty
              <div class="alert alert-success">Tidak Ada Tagihan.</div>
            @endforelse
          </div>
        </div>
        <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="contact-tab">
          <div class="table-responsive">
            <table class="table table-striped dataTable" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tanggal</th>
                  <th>Pembayaran</th>
                  <th>Siswa</th>
                  <th>Kelas</th>
                  <th>Bulan Ke</th>
                  <th>Dibayar</th>
                  <th>Petugas</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pembayaran as $row)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($row->tgl_pembayaran)) }}</td>
                    <td>{{ $row->tagihan->spp->nama }}</td>
                    <td>{{ $row->tagihan->siswa->nama }}</td>
                    <td>{{ $row->tagihan->siswa->kelas->nama }}</td>
                    <td>{{ Helper::getMonth($row->bulan_ke) }}</td>
                    <td>Rp. {{ number_format($row->jumlah) }}</td>
                    <td>{{ $row->user->nama }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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