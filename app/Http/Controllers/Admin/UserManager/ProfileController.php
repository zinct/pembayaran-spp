<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\ChangePassword;
use Illuminate\Support\Facades\Storage;
use Image;

class ProfileController extends BaseController
{
    public function index()
    {
        $data['user'] = \App\User::find(auth()->user()->id);
        return view('admin/user_manager/profile/index', $data);
    }

    public function update(Request $request)
    {
        $model = \App\User::find(auth()->user()->id);

        $request->validate([
            'nama' => 'required',
            'username' => ['required', Rule::unique('user')->ignore(auth()->user()->id)],
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if($file = $request->file('avatar')){
            if($model->avatar != null)
                Storage::disk('public')->delete('assets/img/avatars/' . $model->avatar);
                
            $filename = auth()->user()->id . '.' . $file->getClientOriginalExtension();
            $fileLocation = $request->avatar->storeAs('assets/img/avatars', $filename, 'public');

            Image::make($fileLocation)
            ->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })
            ->crop(500, 500)->save($fileLocation);

            $model->avatar = $filename;
        }

        if($request->old_password != null) {
            $request->validate([
                'old_password' => ['required', new ChangePassword],
                'password' => ['required', 'min:1', 'confirmed'],
            ]);
            $model->password = bcrypt($request->password);
        }

        $model->nama = $request->nama;
        $model->username = $request->username;

        $model->save();
        return back()->with('success', 'Profile Berhasil Diubah!');
    }

    public function deleteAvatar()
    {
        $model = \App\User::find(auth()->user()->id);

        if($model->avatar != null)
            Storage::disk('public')->delete('avatars/' . $model->avatar);
            
        $model->avatar = null;
        $model->save();

        return back()->with('success', 'Profile Berhasil Dihapus!');
    }
}
