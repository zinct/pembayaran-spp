@extends('layout.laporan', compact('identitas'))

@section('content')
<div style="margin-bottom: 1rem;">
  <h3 class="center no-space-h">Laporan Tagihan Siswa</h3>
</div>

<table class="text-sm" border="1" cellspacing="0" width="100%" cellpadding="3">
  <tr class="header">
    <th class="text-center">No</th>
    <th>Siswa</th>
    <th>Kelas</th>
    <th>Tagihan</th>
    <th>Nominal</th>
    <th>Status</th>
  </tr>
  @foreach ($tagihan as $row)
    <tr>
      <td class="text-center">{{ $loop->iteration }}</td>
      <td>{{ $row->siswa->nama }}</td>
      <td>{{ $row->siswa->kelas->nama }}</td>
      <td>{{ $row->spp->nama }}</td>
      <td>Rp. {{ number_format($row->spp->nominal) }}</td>
      <td>{{ $row->view->status }}</td>
    </tr>
  @endforeach 
</table>
@endsection