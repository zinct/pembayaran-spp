<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PembayaranController extends Controller
{
    public function index()
    {
        $data['pembayaran'] = \App\Pembayaran::with('tagihan', 'tagihan.siswa', 'tagihan.siswa.kelas', 'user')->get();
        return view('admin.laporan.pembayaran.index', $data);
    }

    public function laporan(Request $request)
    {
        $data['identitas'] = \App\Identitas::get();
        $pembayaran = \App\Pembayaran::with('user', 'tagihan');
        $data['pembayaran'] = $pembayaran->orderBy('tgl_pembayaran', 'DESC')->get();

        $pdf = PDF::loadView('admin/laporan/pembayaran/laporan', $data)->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
