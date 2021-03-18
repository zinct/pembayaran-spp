<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class KategoriController extends BaseController
{
    public function index()
    {
        $data['kategori'] = \App\Kategori::get();  
        return view('admin/data/kategori/index', $data);
    }

    public function find(\App\Kategori $kategori)
    {
        return $kategori;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $model = new \App\Kategori();
        $model->nama = $request->nama;
        $model->user_id = auth()->user()->id;
        $model->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        
        $model = \App\Kategori::find($id);
        $model->nama = $request->nama;
        $model->user_id = auth()->user()->id;
        $model->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        \App\Kategori::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
