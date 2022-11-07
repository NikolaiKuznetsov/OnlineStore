<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCatalog(Request $request)
    {
        if ($request->keys()){
            $key = $request->keys()[0];
            $value = $request->input($key);

            if ($key === 'sort' && ($value === 'name' || $value === 'year' || $value  === 'price')) {
                $products = Product::where('quantity', '>', 0)->orderBy($value)->paginate(16);
            } elseif ($key === 'page') {
                $products = Product::where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
            }
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

        if ($request->keys()){
            $key = $request->keys()[0];
            $value = $request->input($key);

            if ($key === 'sort' && ($value === 'name' || $value === 'year' || $value  === 'price')) {
                $products = $category->product()->where('quantity', '>', 0)->orderBy($value)->paginate(16);
            } elseif ($key === 'page') {
                $products = $category->product()->where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
            }
        } else {
            $products = $category->product()->where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);
        }

        return view('catalog', [
            'products' => $products,
            'title' => $category->name,
        ]);
    }
}
