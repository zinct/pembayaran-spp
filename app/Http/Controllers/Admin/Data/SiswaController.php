<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SiswaController extends BaseController
{
    public function index()
    {
        $data['siswa'] = \App\Siswa::get();  
        return view('admin/data/siswa/index', $data);
    }

    public function create()
    {
        return view('admin/data/siswa/create');
    }

    public function find(\App\Siswa $siswa)
    {
        return $siswa;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'kelamin' => 'required',
        ]);

        $model = new \App\Siswa();
        $model->nama = $request->nama;
        $model->nisn = $request->nisn;
        $model->nis = $request->nis;
        $model->kelas_id = $request->kelas_id;
        $model->kelamin = $request->kelamin;
        $model->telp = $request->telp;
        $model->alamat = $request->alamat;
        $model->save();
        return redirect()->route('admin.data.siswa.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'kelamin' => 'required',
        ]);
        
        $model = \App\Siswa::find($id);
        $model->nama = $request->nama;
        $model->nisn = $request->nisn;
        $model->nis = $request->nis;
        $model->kelas_id = $request->kelas_id;
        $model->kelamin = $request->kelamin;
        $model->telp = $request->telp;
        $model->alamat = $request->alamat;
        $model->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        \App\Siswa::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
