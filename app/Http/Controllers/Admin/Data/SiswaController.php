<?php

namespace App\Http\Controllers\admin\data;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use DB;

class SiswaController extends BaseController
{
    public function index()
    {
        $data['siswa'] = \App\Siswa::get();
        return view('admin/data/siswa/index', $data);
    }

    public function create()
    {
        $data['kelas'] = \App\Kelas::get();
        return view('admin/data/siswa/create', $data);
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
            'status' => 'required',
        ]);

        DB::transaction(function() use ($request) {

            $model = new \App\Siswa();
            $model->nama = $request->nama;
            $model->nisn = $request->nisn;
            $model->nis = $request->nis;
            $model->kelas_id = $request->kelas_id;
            $model->kelamin = $request->kelamin;
            $model->telp = $request->telp;
            $model->status = $request->status;
            $model->alamat = $request->alamat;
            $model->save();
    
            if($file = $request->file('avatar')){
                if($model->avatar != null)
                    Storage::disk('public')->delete('assets/img/siswa/' . $model->avatar);
                    
                $filename = $model->id . '.' . $file->getClientOriginalExtension();
                $fileLocation = $request->avatar->storeAs('assets/img/siswa', $filename, 'public');
    
                Image::make($fileLocation)
                ->resize(500, null, function($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(500, 500)->save($fileLocation);
    
                $model->avatar = $filename;
            }

            $model->save();

        });
        return redirect()->route('admin.data.siswa.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function edit(\App\Siswa $siswa)
    {
        $data['kelas'] = \App\Kelas::get();
        $data['kelamin'] = ['L', 'P'];
        $data['status'] = ['Aktif', 'Tidak Aktif'];
        return view('admin.data.siswa.edit', $data, compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'kelamin' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function() use ($request, $id) {

            $model = \App\Siswa::find($id);
            $model->nama = $request->nama;
            $model->nisn = $request->nisn;
            $model->nis = $request->nis;
            $model->kelas_id = $request->kelas_id;
            $model->kelamin = $request->kelamin;
            $model->telp = $request->telp;
            $model->status = $request->status;
            $model->alamat = $request->alamat;
            $model->save();
    
            if($file = $request->file('avatar')){
                if($model->avatar != null)
                    Storage::disk('public')->delete('assets/img/siswa/' . $model->avatar);
                    
                $filename = $model->id . '.' . $file->getClientOriginalExtension();
                $fileLocation = $request->avatar->storeAs('assets/img/siswa', $filename, 'public');
    
                Image::make($fileLocation)
                ->resize(500, null, function($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(500, 500)->save($fileLocation);
    
                $model->avatar = $filename;
            }

            $model->save();

        });

        return redirect()->route('admin.data.siswa.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        \App\Siswa::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
