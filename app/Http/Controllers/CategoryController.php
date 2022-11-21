<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCatalog(Request $request)
    {
        $sort = match (request()->input('sort')) {
            'name', 'year', 'price' => request()->input('sort'),
            default => null,
        };
        $products = Product::where('quantity', '>', 0)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy($sort);
            }, function ($query) {
                return $query->orderBy('created_at', 'DESC');
            })->paginate(16);

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

        $sort = match (request()->input('sort')) {
            'name', 'year', 'price' => request()->input('sort'),
            default => null,
        };
        $products = $category->product()->where('quantity', '>', 0)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy($sort);
            }, function ($query) {
                return $query->orderBy('created_at', 'DESC');
            })->paginate(16);

        return view('catalog', [
            'products' => $products,
            'title' => $category->name,
        ]);
    }
}
