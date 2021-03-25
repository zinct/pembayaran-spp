<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('admin.transaksi.pembayaran.index');
    }

    public function show(Request $request)
    {
        $data['siswa'] = \App\Siswa::where('nis', $request->nis)->first();
        
        if($data['siswa'] == null)
            return back()->with('success', 'Maaf siswa tidak ditemukan');

        return view('admin.transaksi.pembayaran.show', $data);
    }

    public function store(Request $request, $id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->spp()->attach($request->spp_id, [
            'status' => 'Belum Lunas',
        ]);
        return back()->with('success', 'Pembayaran Berhasil DiUpdate');
    }

    public function destroy($id, $siswa_id)
    {
        $siswa = \App\Siswa::find($siswa_id);
        $siswa->spp()->detach($id);
        return back()->with('success', 'Data Pembayaran Berhasil Dihapus');
    }
}
