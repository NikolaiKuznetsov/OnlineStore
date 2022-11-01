<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCatalog() {
        $products = Product::where('quantity', '>', 0)->orderBy('created_at', 'DESC')->paginate(16);

        return view('catalog', [
            'products' => $products,
        ]);
    }
}
