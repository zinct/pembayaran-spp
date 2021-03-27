<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;

class KompetensiController extends BaseController
{
    public function index()
    {
        $data['kompetensi'] = \App\Kompetensi::get();
        return view('admin/data/kompetensi/index', $data);
    }

    public function find(\App\Kompetensi $kompetensi)
    {
        return $kompetensi;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $model = new \App\Kompetensi();
        $model->nama = $request->nama;
        $model->save();
        return redirect()->route('admin.data.kompetensi.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        
        $model = \App\Kompetensi::find($id);
        $model->nama = $request->nama;
        $model->save();
        return redirect()->route('admin.data.kompetensi.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        try {
            \App\Kompetensi::destroy($id);
            return back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            if($e->getCode() == 23000)
                return back()->with('error', 'Data Ini Sedang Digunakan');
            return back()->with('error', "Terjadi Kesalahan Dengan Kode {$e->getCode()}");
        }
    }
}
