<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('login');
    }

    public function signInProcess(Request $request): RedirectResponse
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
        session(['login' => $request->email]);

        return redirect()->intended(route('home'));
    }

    public function signUp()
    {
        return view('register');
    }

    public function signUpProcess(Request $request)
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

        $user = User::query()->create($data);

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
