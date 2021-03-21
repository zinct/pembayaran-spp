<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use DB;

class SppController extends BaseController
{
    public function index()
    {
        $data['spp'] = \App\Spp::get();
        return view('admin/data/spp/index', $data);
    }

    public function create()
    {
        $data['tahun'] = \App\Tahun::get();
        $data['kelas'] = \App\Kelas::get();
        return view('admin/data/spp/create', $data);
    }

    public function find(\App\Spp $spp)
    {
        return $spp;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_id' => 'required',
            'nominal' => 'required',
            'tipe' => 'required',
        ]);
        
        DB::transaction(function() use ($request) {
            
            $model = new \App\Spp();

            $model->nama = $request->nama;
            $model->tahun_id = $request->tahun_id;
            $model->nominal = $request->nominal;
            $model->tipe = $request->tipe;
            $model->save();

            $model->kelas()->attach($request->kelas_id);

        });
        return redirect()->route('admin.data.spp.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function edit(\App\Spp $spp)
    {
        $data['tahun'] = \App\Tahun::get();
        $data['kelas'] = \App\Kelas::get();
        $data['tipe'] = ['Bulanan', 'Bebas'];
        return view('admin.data.spp.edit', $data, compact('spp'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_id' => 'required',
            'nominal' => 'required',
            'tipe' => 'required',
        ]);
        
        DB::transaction(function() use ($request, $id) {
            
            $model =  \App\Spp::find($id);

            $model->nama = $request->nama;
            $model->tahun_id = $request->tahun_id;
            $model->nominal = $request->nominal;
            $model->tipe = $request->tipe;
            $model->save();

            $model->kelas()->sync($request->kelas_id);

        });
        return redirect()->route('admin.data.spp.index')->with('success', 'Data Berhasil DiUpdate');
    }
    
    public function destroy($id)
    {
        \App\Spp::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
