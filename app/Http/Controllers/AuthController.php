<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginProcess(Request $request): RedirectResponse
    {
        $validate = Auth::attempt($request->validate([
            'login' => ['required', 'string'],
            'password' => ['required']
        ]));

        if(!$validate) {
            return back()->withErrors([
                'login' => 'Не верное имя пользователя и/или пароль.'
            ])->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function register()
    {
        return view('register');
    }

    public function registerProcess(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'regex:/^[\x{0400}-\x{04FF}\- ]+$/u', 'string'],
            'surname' => ['required', 'regex:/^[\x{0400}-\x{04FF}\- ]+$/u', 'string'],
            'patronymic' => ['regex:/^[\x{0400}-\x{04FF}\- ]+$/u', 'string'],
            'login' => ['required', 'unique:users,login', 'regex:/^[0-9A-Za-z\-]+$/', 'string'],
            'email' => ['required', 'unique:users,email', 'email', 'string'],
            'password' => ['required', 'confirmed', 'min:6'],
            'rules' => ['required'],
        ]);

        $user = User::query()->create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {
            Auth::login($user);
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        auth('web')->logout();

        return redirect()->route('about');
    }
}
