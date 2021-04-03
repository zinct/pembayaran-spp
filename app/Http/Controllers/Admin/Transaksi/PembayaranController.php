<?php

namespace App\Http\Controllers\Admin\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('admin.transaksi.pembayaran.index');
    }
    
    public function create(Request $request)
    {
        $data['siswa'] = \App\Siswa::where('nis', $request->nis)->first();
        
        if($data['siswa'] == null)
            return back()->with('error', 'Maaf siswa tidak ditemukan');

        if($data['siswa']->status == 'Tidak Aktif')
            return back()->with('error', 'Maaf siswa tidak aktif');

        return view('admin.transaksi.pembayaran.create', $data);
    }

    public function store(Request $request, $id)
    {
        DB::transaction(function() use($request) {

            foreach($request->tagihan_id as $tagihan_id) {
                $model = new \App\Pembayaran();
                $model->tgl_pembayaran = date('Y-m-d H:i:s');
                $model->tagihan_id = $tagihan_id;
                $model->jumlah = \App\Tagihan::find($tagihan_id)->spp->nominal / 12;
                $model->bulan_ke = $request->bulan[$tagihan_id];
                $model->user_id = auth()->user()->id;
                $model->save();
            }
            
        });

        return back()->with('success', 'Berhasil Melakukan Pembayaran');
    }
}
