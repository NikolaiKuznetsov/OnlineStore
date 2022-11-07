<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->guest()) {
            return redirect()->route('admin.login');
        }

        return view('admin.home', [
            'title' => 'Главная страница',
        ]);
    }
}
