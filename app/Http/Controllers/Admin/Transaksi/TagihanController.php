<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function find(\App\Tagihan $tagihan)
    {
        $tagihan->load('spp');
        return $tagihan;
    }

    public function store(Request $request, $id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->spp()->attach($request->spp_id);
        return back()->with('success', 'Pembayaran Berhasil DiUpdate');
    }

    public function destroy($id, $siswa_id)
    {
        $siswa = \App\Siswa::find($siswa_id);
        $siswa->spp()->detach($id);
        return back()->with('success', 'Data Pembayaran Berhasil Dihapus');
    }
}
