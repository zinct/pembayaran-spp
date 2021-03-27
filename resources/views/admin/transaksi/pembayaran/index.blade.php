@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Pembayaran</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Cari Siswa</div>
  </div>
@endsection

@section('content')
  <div id="app">
    <form action="{{ route('admin.transaksi.pembayaran.show') }}" method="GET">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-8 mx-auto">
              <input class="form-control form-control-lg text-lg" v-on:keyup.enter.prevent="searchSiswa" id="search" name="nis" type="text" autofocus="on" placeholder="Masukan NIS siswa ex. 181912070084">
            </div> 
            <div class="row mt-1" style="min-height: 185px;"><div class="col-md-6 mx-auto">
              <img src="{{ url('assets/img/search.png') }}" alt="" class="w-75" style="opacity: 0.3;">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('script')
  @include('vendor.izitoast.toast')
@endsection