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

    public function show(\App\Siswa $siswa)
    {
        $data['spp'] = \App\Spp::whereHas('kelas', function($query) use($siswa) {
            return $query->where('kelas_id', $siswa->kelas_id);
        })->get();

        $data['pembayaran'] = \App\Pembayaran::whereHas('tagihan', function($query) use($siswa) {
            return $query->where('siswa_id', $siswa->id);
        })->orderBy('tgl_pembayaran', 'DESC')->get();

        return view('admin/data/siswa/show', $data, compact('siswa'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'kelas_id' => 'required',
            'kelamin' => 'required',
            'password' => 'required|confirmed',
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
            $model->password = bcrypt($request->password);
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
                })->save($fileLocation);
    
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
            'password' => 'confirmed',
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
                })->save($fileLocation);
    
                $model->avatar = $filename;
            }

            if($request->password) {
                $model->password = bcrypt($request->password);
            }

            $model->save();

        });

        return redirect()->route('admin.data.siswa.index')->with('success', 'Data Berhasil Ditambahkan');
    }
    
    public function destroy($id)
    {
        try {
            \App\Siswa::destroy($id);
            return back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            if($e->getCode() == 23000)
                return back()->with('error', 'Data Ini Sedang Digunakan');
            return back()->with('error', "Terjadi Kesalahan Dengan Kode {$e->getCode()}");
        }
    }
}
