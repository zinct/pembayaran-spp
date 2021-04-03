
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Pembayaran SPP</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  
  <!-- CSS Libraries -->
  <link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
  
  <!-- Custom CSS -->
  @yield('css')
  
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="javascript:void(0)" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ url('assets/img/avatars/' . Helper::nullreplace(auth()->user()->avatar, 'default.png')) }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->nama }} ({{ auth()->user()->role->nama }})</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Menu</div>
              <a href="{{ route('admin.user-manager.profile.index') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              @can('setting.identitas')
              <a href="{{ route('admin.setting.identitas.index') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              @endcan
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Pembayaran SPP</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="javascript:void(0)">SP</a>
          </div>
          <ul class="sidebar-menu">
            <li>
              <a class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'dashboard') ? 'text-primary' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>
            @canany(['transaksi.pembayaran'])
            <li class="menu-header">Transaction Management</li>
            @endcanany
            @can('transaksi.pembayaran')
              <li>
                <a class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'transaksi' && request()->segment(3) == 'pembayaran') ? 'text-primary' : '' }}" href="{{ route('admin.transaksi.pembayaran.index') }}"><i class="fas fa-money-bill"></i> <span>Pembayaran</span></a>
              </li>
            @endcan
            @canany(['laporan.pembayaran'])
            <li class="menu-header">Info Management</li>
            @endcanany
            @canany(['laporan.pembayaran'])
            <li class="nav-item dropdown {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'laporan') ? 'active' : '' }}">
              <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bullhorn"></i> <span>Laporan</span></a>
              <ul class="dropdown-menu">
                @can('laporan.tagihan')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'laporan' && request()->segment(3) == 'tagihan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.laporan.tagihan.index') }}">Tagihan Siswa</a></li>
                @endcan
                @can('laporan.pembayaran')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'laporan' && request()->segment(3) == 'pembayaran') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.laporan.pembayaran.index') }}">Histori Pembayaran</a></li>
                @endcan
              </ul>
            </li>
            @endcanany
            @canany(['data.siswa', 'data.kompetensi', 'data.spp', 'data.tahun'])
            <li class="menu-header">Data Management</li>
            @endcanany
            @canany(['data.siswa', 'data.kompetensi', 'data.spp', 'data.tahun'])
            <li class="nav-item dropdown {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'data') ? 'active' : '' }}">
              <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-folder"></i> <span>Master Data</span></a>
              <ul class="dropdown-menu">
                @can('data.siswa')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'data' && request()->segment(3) == 'siswa') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.data.siswa.index') }}">Data Siswa</a></li>
                @endcan
                @can('data.kelas')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'data' && request()->segment(3) == 'kelas') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.data.kelas.index') }}">Data Kelas</a></li>
                @endcan
                @can('data.kompetensi')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'data' && request()->segment(3) == 'kompetensi') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.data.kompetensi.index') }}">Data Kompetensi</a></li>
                @endcan
                @can('data.spp')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'data' && request()->segment(3) == 'spp') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.data.spp.index') }}">Data SPP</a></li>
                @endcan
                @can('data.tahun')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'data' && request()->segment(3) == 'tahun') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.data.tahun.index') }}">Tahun Ajaran</a></li>
                @endcan
              </ul>
            </li>
            @endcanany
            <li class="nav-item dropdown {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'user-manager') ? 'active' : '' }}">
              <a href="javascript:void(0)" class="nav-link has-dropdown"><i class="fas fa-user"></i> <span>Manajemen User</span></a>
              <ul class="dropdown-menu">
                @can('user-manager.user')
                  <li><a class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'user-manager' && request()->segment(3) == 'user') ? 'text-primary' : '' }}" href="{{ route('admin.user-manager.user.index') }}">Data User</a></li>
                @endcan
                @can('user-manager.role')
                  <li><a class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'user-manager' && request()->segment(3) == 'role') ? 'text-primary' : '' }}" href="{{ route('admin.user-manager.role.index') }}">Role & Permission</a></li>
                @endcan
                @can('user-manager.permission')
                  <li><a class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'user-manager' && request()->segment(3) == 'permission') ? 'text-primary' : '' }}" href="{{ route('admin.user-manager.permission.index') }}">Permission</a></li>
                @endcan
                <li><a class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'user-manager' && request()->segment(3) == 'profile') ? 'text-primary' : '' }}" href="{{ route('admin.user-manager.profile.index') }}">Profile</a></li>
              </ul>
            </li>
            @canany(['setting.identitas'])
            <li class="nav-item dropdown {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'setting') ? 'active' : '' }}">
              <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wrench"></i> <span>Setting</span></a>
              <ul class="dropdown-menu">
                @can('setting.identitas')
                  <li class="{{ (request()->segment(1) == 'admin' && request()->segment(2) == 'setting' && request()->segment(3) == 'identitas') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setting.identitas.index') }}">Identitas</a></li>
                @endcan
              </ul>
            </li>
            @endcanany
          </ul>      
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            @yield('header')
          </div>

          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Pembayaran SPP <div class="bullet"></div> Copyright &copy; 2020 / 2021 by <a href="https://github.com/zinct">Indra Mahesa</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  @yield('modal')

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ url('assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous"></script>
  <script src="{{ url('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
  <script>
    AutoNumeric.multiple('.numeric', { digitGroupSeparator: '.', decimalCharacter: ',', decimalPlaces: '0', unformatOnSubmit: true });
  </script>
  <script>
    $(document).ready( function () {
        $('.dataTable').DataTable();
    });
  </script>

  <!-- Template JS File -->
  <script src="{{ url('assets/js/scripts.js') }}"></script>
  <script src="{{ url('assets/js/custom.js') }}"></script>

  @yield('script')

</body>
</html>