<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;

class KelasController extends BaseController
{
    public function index()
    {
        $data['kelas'] = \App\Kelas::get();
        $data['kompetensi'] = \App\Kompetensi::get();
        return view('admin/data/kelas/index', $data);
    }

    public function find(\App\Kelas $kelas)
    {
        return $kelas;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kompetensi_id' => 'required',
        ]);

        $model = new \App\Kelas();
        $model->nama = $request->nama;
        $model->kompetensi_id = $request->kompetensi_id;
        $model->save();
        return redirect()->route('admin.data.kelas.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kompetensi_id' => 'required',
        ]);
        
        $model = \App\Kelas::find($id);
        $model->nama = $request->nama;
        $model->kompetensi_id = $request->kompetensi_id;
        $model->save();
        return redirect()->route('admin.data.kelas.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        try {
            \App\Kelas::destroy($id);
            return back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            if($e->getCode() == 23000)
                return back()->with('error', 'Data Ini Sedang Digunakan');
            return back()->with('error', "Terjadi Kesalahan Dengan Kode {$e->getCode()}");
        }
    }
}
