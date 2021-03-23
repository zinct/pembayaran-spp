<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    public function index()
    {
        $data['permission'] = \App\Permission::get();
        return view('admin/user_manager/permission/index', $data);
    }

    public function find(\App\Permission $permission)
    {
        return $permission;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $model = new \App\Permission();
        $model->nama = $request->nama;
        $model->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        
        $model = \App\Permission::find($id);
        $model->nama = $request->nama;
        $model->save();
        return back()->with('success', 'Data Berhasil DiUpdate');
    }
    
    public function destroy($id)
    {
        \App\Permission::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}