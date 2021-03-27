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
  <div id="app">
    <form action="{{ route('admin.transaksi.transaksi.store', $siswa->id) }}" method="POST">
      @csrf
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div id="accordion">
                @foreach ($siswa->spp as $row)
                  <div class="accordion">
                    <div class="accordion-header bg-primary text-white collapsed" role="button" data-toggle="collapse" data-target="#panel-body-{{ $row->id }}">
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
                                $bulan_sekarang = DB::table('v_transaksi')->where('id', $row->id)->first()->bulan_ke;
                              @endphp
                              @if ($bulan_sekarang >= $i)
                                <button type="button" class="btn btn-sm btn-success" style="width: 100%">Lunas</button>
                              @elseif ($bulan_sekarang == ($i - 1))
                                <button type="button" class="btn btn-sm btn-primary" v-on:click="addItem({{ $row->id }}, {{ $i }})" style="width: 100%">Bayar</button>
                              @else
                                <button type="button" class="btn btn-sm btn-secondary" style="width: 100%">Belum Lunas</button>
                              @endif
                            </div>
                          </div>
                        @endfor
                      </div> 
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h6 class="card-title">Pembayaran Detail</h6>
                    <div class="spinner-border text-danger spinner-border-sm" v-if="isLoading" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
                  <div v-if="carts.length != 0" v-for="cart in carts" class="d-flex justify-content-between border-bottom py-4">
                    <div>
                      <span><strong>@{{ cart.nama }}</strong></span><br>
                      <span class="small">@{{ getMonth(cart.month) }}</span>
                    </div>
                    <div>
                      <span>Rp. @{{ formatPrice(cart.nominal) }}</span>
                      <button type="button" class="btn text-danger" v-on:click="removeItem(cart.id, cart.month)"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <input type="hidden" name="pembayaran_id[]" v-bind:value="cart.id">
                    <input type="hidden" v-bind:name="'bulan[' + cart.id + ']'" v-bind:value="cart.month">
                  </div>
                  <div v-if="carts.length == 0">
                      <img alt="image" class="img-fluid" style="opacity: 0.3" src="https://demospp.isengoding.my.id/img/undraw_empty_cart_co35.png">
                  </div>
                </div>
                <div class="py-4">
                  <h6>Total Bayar</h6>
                  <h4>Rp. @{{ formatPrice(calculateTotal) }}-</h4>
                </div>
                <button type="submit" :disabled="this.carts.length == 0" class="btn btn-primary btn-primary">Lanjutkan Pembayaran</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('script')
  @include('vendor/izitoast/toast')
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

  <script>
    const app = new Vue({
      el: '#app',
      data: {
        isLoading: false,
        carts: [],
        total: 0
      },
      methods: {
        addItem: function(id, month) {
          this.isLoading = true;
          fetch(`{{ url('admin/data/spp/data/${id}') }}`).then(response => {
            return response.json();
          }).then(data => {

            for (let i = 0; i < this.carts.length; i++) {
              if(this.carts[i].id == data.id && this.carts[i].month == month) {
                this.isLoading = false;
                return;
              }
            }

            this.carts.push({
              id: data.id,
              nama: data.nama,
              nominal: data.nominal,
              tipe: data.tipe,
              month: month,
            });

            this.isLoading = false;

          }).catch(err => {
            console.warn('Terjadi Kesalahan!', err);
          });
        },
        removeItem: function(id, month) {
          for (let i = 0; i < this.carts.length; i++) {
            if(this.carts[i].id == id && this.carts[i].month == month) {
              this.carts.splice(i, 1);
              return;
            }
          }
        },
        getMonth: function(month) {
          const months = [0, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
          return months[month]
        },
        formatPrice: function(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
      },
      computed: {
        calculateTotal: function() {
          if(this.carts.length == 0) return 0;
          return this.carts.reduce((total, data) => {
            return total + Number(data.nominal);
          }, 0);
        }
      }
    });
  </script>
@endsection