<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected function index()
    {
        return view('auth/login');
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);
            
        if(auth()->guard()->attempt(['username' => $request->username, 'password' => $request->password]))
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
        if(auth()->guard('admin')->check()) {
            auth()->guard('admin')->logout();
            return redirect()->route('login');
        } else {
            auth()->guard('user')->logout();
            return redirect()->route('login');
        }
    }
}
