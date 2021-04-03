@extends('layout/admin')

@section('header')
  <h1>Dashboard</h1>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Siswa</h4>
          </div>
          <div class="card-body">
            {{ $siswa }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-male"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Laki - Laki</h4>
          </div>
          <div class="card-body">
            {{ $laki_laki }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-female"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Perempuan</h4>
          </div>
          <div class="card-body">
            {{ $perempuan }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-secondary">
          <i class="fa fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Tidak Aktif</h4>
          </div>
          <div class="card-body">
            {{ $siswa_non }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Statistik</h4>
        </div>
        <div class="card-body">
          <canvas id="myChart" height="182"></canvas>
          <div class="statistic-details mt-sm-4">
            <div class="statistic-details-item">
              <div class="detail-value">{{ $tagihan }}</div>
              <div class="detail-name">Jumlah Tagihan</div>
            </div>
            <div class="statistic-details-item">
              <div class="detail-value">{{ $pembayaran }}</div>
              <div class="detail-name">Jumlah Transaksi</div>
            </div>
            <div class="statistic-details-item">
              <div class="detail-value">Rp. {{ number_format($pemasukan) }}</div>
              <div class="detail-name">Pemasukan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Aktivitas Baru</h4>
        </div>
        <div class="card-body">
          <ul class="list-unstyled list-unstyled-border">
            @forelse ($aktivitas as $row)
              <li class="media">
                <img class="mr-3" width="50" src="{{ url('assets/img/siswa/' . Helper::nullReplace($row->tagihan->siswa->avatar, 'default.png')) }}" alt="avatar">
                <div class="media-body">
                  <div class="float-right text-primary">{{ date('Y-m-d H:i', strtotime($row->tgl_pembayaran)) }}</div>
                  <div class="media-title">{{ $row->tagihan->siswa->nama }} <br> <span class="text-muted">{{ $row->tagihan->siswa->kelas->nama }}</span></div>
                  <span class="text-small text-muted">Melakukan pembayaran pada tagihan ({{ $row->tagihan->spp->nama }}) sebesar Rp. {{ number_format($row->jumlah) }}.</span>
                </div>
              </li>
            @empty
              <li class="media">
                <div class="media-body">
                  <div class="text-center">Tidak Ada Data</div>
                </div>
              </li>
            @endforelse
          </ul>
          <div class="text-center">
            <a href="{{ route('admin.laporan.pembayaran.index') }}" class="btn btn-primary mt-4" style="width: 100%">
              Lihat Semua
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

  <script>
    new Chart(document.getElementById('myChart'), {
        type: 'pie',
        data: {
            labels: ['Lunas', 'Belum Lunas'],
            datasets: [{
                label: 'Pemasukan',
                data: [{{ $lunas }}, {{ $belum_lunas }}],
                backgroundColor: [
                'rgb(84, 102, 237)'
                ],
                borderColor: [
                    'rgb(84, 102, 237)'
                ],
                borderWidth: 3,
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 10,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
            }]
        },
        options: {
            scales: {
                xAxes: [{
                  gridLines: {
                    display: false,
                    drawBorder: false
                  }
                }],
                yAxes: [{
                    ticks: {
                      drawBorder: false,
                      display: false
                    },
                }]
            }
        }
    });
  </script>

@endsection