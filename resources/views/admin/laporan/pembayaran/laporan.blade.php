@extends('layout.laporan', compact('identitas'))

@section('content')
<div style="margin-bottom: 1rem;">
  <h3 class="center no-space-h">Laporan Pembayaran</h3>
</div>

<table class="text-sm" border="1" cellspacing="0" width="100%" cellpadding="3">
  <tr class="header">
    <th class="text-center">No</th>
    <th>Tanggal</th>
    <th>Pembayaran</th>
    <th>Siswa</th>
    <th>Kelas</th>
    <th>Bulan Ke</th>
    <th>Dibayar</th>
    <th>Petugas</th>
  </tr>
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
</table>
@endsection