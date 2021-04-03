<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class TagihanController extends Controller
{
    public function index()
    {
        $data['tagihan'] = \App\Tagihan::get();
        return view('admin.laporan.tagihan.index', $data);
    }

    public function laporan(Request $request)
    {
        $data['identitas'] = \App\Identitas::get();
        $data['tagihan'] = \App\Tagihan::with('siswa', 'spp', 'siswa.kelas', 'view')->get();

        $pdf = PDF::loadView('admin/laporan/tagihan/laporan', $data)->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
