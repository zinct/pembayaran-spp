<?php

namespace App\Http\Controllers\Admin\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request, $id)
    {
        return $request->all();
        foreach($request->pembayaran_id as $pembayaran_id) {
            $model = new \App\Pembayaran();
            $model->tgl_transaksi = date('Y-m-d H:i:s');
            $model->pembayaran_id = $pembayaran_id;

        }
    }
}
