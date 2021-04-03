<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    protected function index()
    {
        return view('auth/login');
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);
            
        if(auth()->guard('siswa')->attempt(['nis' => $request->username, 'password' => $request->password])) 
            return redirect()->route('siswa.home');

        if(auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) 
            return redirect()->route('admin.dashboard');

        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }
    
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    }

    protected function logout()
    {
        if (Auth::guard('admin')->check()) {

            Auth::guard('admin')->logout();
            return redirect()->route('login');

        } else if(Auth::guard('siswa')->check()) {

            Auth::guard('siswa')->logout();
            return redirect()->route('login');

        }
    }
}
