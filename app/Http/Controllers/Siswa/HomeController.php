<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $siswa = null; 
    protected $identitas = null; 

    public function __construct()
    {
        $this->middleware('auth:siswa');
        $this->middleware(function ($request, $next) {
            $this->siswa = Auth::user();
            return $next($request);
        });
        $this->identitas = \App\Identitas::get();
    }

    public function index()
    {
        $pembayaran = \App\Pembayaran::whereHas('tagihan', function($query) {
            return $query->where('siswa_id', $this->siswa->id);
        })->orderBy('tgl_pembayaran', 'DESC')->get();
        return view('siswa.home.index', array('siswa' => $this->siswa, 'identitas' => $this->identitas, 'pembayaran' => $pembayaran));
    }
}
