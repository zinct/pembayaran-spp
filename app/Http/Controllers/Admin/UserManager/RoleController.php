<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use DB;

class RoleController extends BaseController
{
    public function index()
    {
        $data['role'] = \App\Role::get();  
        return view('admin/user_manager/role/index', $data);
    }

    public function find(\App\Role $role)
    {
        return $role;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $model = new \App\Role();
        $model->nama = $request->nama;
        $model->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data['role'] = \App\Role::find($id);
        $data['transaksi_permission'] = DB::table('permission')->where('nama', 'like', 'transaksi%')->get();
        $data['laporan_permission'] = DB::table('permission')->where('nama', 'like', 'laporan%')->get();
        $data['data_permission'] = DB::table('permission')->where('nama', 'like', 'data%')->get();
        $data['usermanager_permission'] = DB::table('permission')->where('nama', 'like', 'user-manager%')->get();
        $data['setting_permission'] = DB::table('permission')->where('nama', 'like', 'setting%')->get();
        return view('admin/user_manager/role/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $model = \App\Role::find($id);
        $model->nama = $request->nama;
        $model->save();

        // Permission Handler
        $permissions = [];
        foreach($request->keys() as $row) {
            if($row == '_token' || $row == '_method' || $row == 'nama') continue;
            array_push($permissions, $row);
        }
        
        $model->permissions()->sync($permissions);
        return redirect()->route('admin.user-manager.role.index')->with('success', 'Data Berhasil DiUbah');
    }
    
    public function destroy($id)
    {
        \App\Role::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
