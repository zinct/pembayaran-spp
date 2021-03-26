<?php

namespace App\Http\Controllers\Admin\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TransaksiController extends Controller
{
    public function store(Request $request, $id)
    {
        DB::transaction(function() use($request) {
            foreach($request->pembayaran_id as $pembayaran_id) {
                $model = new \App\Pembayaran();
                $model->tgl_transaksi = date('Y-m-d H:i:s');
                $model->pembayaran_id = $pembayaran_id;
                $model->nominal = \App\Tagihan::find($pembayaran_id)->spp->nominal / 12;
                $model->bulan_ke = $request->bulan[$pembayaran_id];
                $model->user_id = auth()->user()->id;
                $model->save();
            }
        });

        return back()->with('success', 'Berhasil Melakukan Pembayaran');
    }
}
