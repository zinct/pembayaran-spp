<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        $data['siswa'] = \App\Siswa::where('status', 'Aktif')->count();
        $data['siswa_non'] = \App\Siswa::where('status', 'Tidak Aktif')->count();
        $data['tagihan'] = \App\TagihanView::count();
        $data['pembayaran'] = \App\Pembayaran::count();
        $data['lunas'] = \App\TagihanView::where('status', 'Lunas')->count();
        $data['belum_lunas'] = \App\TagihanView::where('status', 'Belum Lunas')->count();
        $data['laki_laki'] = \App\Siswa::where(['status' => 'Aktif', 'kelamin' => 'L'])->count();
        $data['perempuan'] = \App\Siswa::where(['status' => 'Aktif', 'kelamin' => 'P'])->count();

        $data['aktivitas'] = \App\Pembayaran::take(4)->orderBy('tgl_pembayaran', 'DESC')->get();
        return view('admin/dashboard/index', $data);
    }
}
