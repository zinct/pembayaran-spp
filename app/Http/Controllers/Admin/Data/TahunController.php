<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class TahunController extends BaseController
{
    public function index()
    {
        $data['tahun'] = \App\Tahun::get();
        return view('admin/data/tahun/index', $data);
    }

    public function find(\App\Tahun $tahun)
    {
        return $tahun;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $model = new \App\Tahun();
        $model->nama = $request->nama;
        $model->save();
        return redirect()->route('admin.data.tahun.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        
        $model = \App\Tahun::find($id);
        $model->nama = $request->nama;
        $model->save();
        return redirect()->route('admin.data.tahun.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        try {
            \App\Tahun::destroy($id);
            return back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            if($e->getCode() == 23000)
                return back()->with('error', 'Data Ini Sedang Digunakan');
            return back()->with('error', "Terjadi Kesalahan Dengan Kode {$e->getCode()}");
        }
    }
}
