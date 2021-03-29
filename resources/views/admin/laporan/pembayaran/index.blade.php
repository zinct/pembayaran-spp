@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Laporan Pembayaran</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Laporan Pembayaran</div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-header iseng-sticky bg-white">
      <h4>Laporan Pembayaran</h4>
      <div class="card-header-action">
        <a href="{{ route('admin.laporan.pembayaran.laporan') }}" target="_blank" class="btn btn-primary">Cetak PDF</a>
      </div>
    </div>
    <div class="card-body">
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