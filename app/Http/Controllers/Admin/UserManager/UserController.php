<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\BaseController;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        $data['user'] = \App\User::get();
        $data['role'] = \App\Role::get();
        return view('admin/user_manager/user/index', $data);
    }

    public function find(\App\User $user)
    {
        return $user;
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:user',
            'password' => 'required|min:1|confirmed',
        ]);

        $model = new \App\User();

        $model->nama = $request->nama;
        $model->username = $request->username;
        $model->role_id = $request->role_id;
        $model->password = bcrypt($request->password);
        
        $model->save();
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $model = \App\User::find($id);

        $request->validate([
            'nama' => 'required',
            'username' => ['required', Rule::unique('user')->ignore($id)],
        ]);

        if($request->password != null) {
            $request->validate([
                'password' => ['required', 'min:1', 'confirmed'],
            ]);
            $model->password = bcrypt($request->password);
        }

        $model->nama = $request->nama;
        $model->username = $request->username;
        $model->role_id = $request->role_id;

        $model->save();
        return back()->with('success', 'Data Berhasil DiUpdate');
    }
    
    public function destroy($id)
    {
        \App\User::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
