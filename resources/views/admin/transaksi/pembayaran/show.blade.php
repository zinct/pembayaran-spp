@extends('layout/admin')

@section('header')
  <div class="section-header-back">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
  </div>
  <h1>Pembayaran</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Pembayaran</div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col">
          

          <div class="card card-info pembayaranDetail">
            <div class="card-body" >
                <div class="d-flex justify-content-between">
                    <h6 class="card-title">Pembayaran Detail</h6>
                    <div v-if="submitCart" class="spinner-border text-danger spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                
                <div>
                    <div v-if="cartTotal > 0">
                        <div class="d-flex justify-content-between border-bottom py-4" v-for="row in cart" :key="row.id">
                            <div>
                                <span><strong>{{ row.name }}</strong></span><br>
                                <span class="small">{{ row.options.keterangan }}</span>
                            </div>
                            <div>
                                <span>Rp.{{ row.price }}-</span>
                                <button class="btn text-danger" @click="deleteItem(row.rowId, row.id)"><i class="fas fa-times-circle    "></i></button>
                            </div>
                        </div>
                    </div>
                    <div v-else class="d-flex justify-content-center">
                        <img alt="image" style="opacity: 0.3" height="90px" width="90px" src="https://demospp.isengoding.my.id/img/undraw_empty_cart_co35.png">
                    </div>
                </div>
                
                <div class="py-4 ">
                    <h6>Total Bayar</h6>
                    <h4>Rp.{{cartTotal}}-</h4>
                </div>
                <label for="">Pilih Metode Pembayaran :</label>
                <select v-model="metode" class="form-control mb-3" name="metode">
                    
                    <option value="gopay">GOPAY</option>
                    <option value="bca_va">BCA Virtual Account</option>
                    <option value="permata_va">Permata Virtual Account</option>
                    <option value="echannel">Mandiri Virtual Account</option>
                    <option value="bni_va">BNI Virtual Account</option>
                    <option value="other_va">Bank Lain</option>
                </select>
                
                
                <!-- Button trigger modal -->
                <button class="btn btn-primary btn-block" v-if="cartTotal <= 0" disabled>Lanjutkan Pembayaran</button>
                <button v-else class="btn btn-primary btn-block" @click="showModal = true">Lanjutkan Pembayaran</button>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
@endsection