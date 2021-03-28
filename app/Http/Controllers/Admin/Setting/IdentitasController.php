<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Image;

class IdentitasController extends BaseController
{
    public function index()
    {
        $data['identitas'] = \App\Identitas::get();
        return view('admin.setting.identitas.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo_sekolah' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama_sekolah' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'website' => 'required',
            'alamat' => 'required',
        ]);

        $fileExtension = null;
        if($file = $request->file('logo_sekolah')){

            // clean all file
            $dir = new Filesystem();
            $dir->cleanDirectory('assets/img/identitas');
            
            $filename = 'Logo Sekolah' . "." . $file->getClientOriginalExtension();
            $fileLocation = $request->logo_sekolah->storeAs('assets/img/identitas', $filename, 'public');

            Image::make($fileLocation)
            ->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->crop(500, 500)->save($fileLocation);

            $fileExtension = $filename;
        }

        \App\Identitas::truncate();
        foreach($request->keys() as $row) {

            if($row == '_token') continue;
            if($row == 'logo_sekolah') continue;
            \App\Identitas::insert(['key' => $row,'value' => $request->all($row)[$row]]);
        }

        if($fileExtension != null)
            \App\Identitas::insert(['key' => 'logo_sekolah','value' => $fileExtension]);

        return back()->with('success', 'Berhasil Mengupdate Data');
    }
}
