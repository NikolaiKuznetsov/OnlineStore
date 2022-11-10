<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCatalog(Request $request)
    {
        $key = $request->keys();

        if ($key && $key[0] === 'sort' && ($request->input($key[0]) === 'name' || $request->input($key[0]) === 'year' || $request->input($key[0])  === 'price')) {
            $products = Product::where('quantity', '>', 0)->orderBy($request->input($key[0]))->paginate(16);
        } elseif ($key && $key[0] === 'page') {
            $products = Product::where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
        } else {
            $products = Product::where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
        }

        return view('catalog', [
            'products' => $products,
            'title' => 'Каталог',
        ]);
    }

    public function showCategory($slug, Request $request)
    {
        $category = Category::whereSlug($slug)->first();
        if (!$category) {
            abort(404);
        }

        $key = $request->keys();

        if ($key && $key[0] === 'sort' && ($request->input($key[0]) === 'name' || $request->input($key[0]) === 'year' || $request->input($key[0])  === 'price')) {
            $products = $category->product()->where('quantity', '>', 0)->orderBy($request->input($key[0]))->paginate(16);
        } elseif ($key && $key[0] === 'page') {
            $products = $category->product()->where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
        } else {
            $products = $category->product()->where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
        }

        return view('catalog', [
            'products' => $products,
            'title' => $category->name,
        ]);
    }
}
