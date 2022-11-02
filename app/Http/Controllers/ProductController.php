<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('quantity', '>', 0)->limit(16)->get();
        return view('home', ['products' => $products]);
    }

    public function showAbout()
    {
        $products = Product::orderBy('created_at', 'DESC')->limit(5)->get();
        return view('about', ['products' => $products]);
    }
}
