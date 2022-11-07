<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected string $redirectTo = '/admin';

    protected function redirectTo()
    {
        if (auth('admin')->guest()) {
            return route('admin/login');
        }
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $validate = Auth::guard('admin')->attempt($request->validate([
            'login' => ['required', 'string'],
            'password' => ['required']
        ]));

        if(!$validate) {
            return back()->withErrors([
                'login' => 'Не верное имя пользователя и/или пароль.'
            ])->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.home'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.home');
    }
}
