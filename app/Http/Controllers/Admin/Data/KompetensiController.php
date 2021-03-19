<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class KompetensiController extends BaseController
{
    public function index()
    {
        $data['kompetensi'] = \App\Kompetensi::get();
        return view('admin/data/kompetensi/index', $data);
    }

    public function create()
    {
        return view('admin/data/kompetensi/create');
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
    
    public function edit(\App\Kompetensi $kompetensi)
    {
        $data['kelamin'] = ['L', 'P'];
        return view('admin.data.kompetensi.edit', $data, compact('kompetensi'));
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
        \App\Kompetensi::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
