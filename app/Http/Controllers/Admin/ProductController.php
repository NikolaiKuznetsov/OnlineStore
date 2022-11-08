<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'DESC')->paginate(20);

        return view('admin.product', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.product_create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'image' => ['required', 'image'],
            'country' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'model' => ['required', 'string'],
            'quantity' => ['required', 'integer'],
            'category' => ['required', 'exists:categories,id']
        ]);

        $data['image'] = str_replace('products/', '', $request->file('image')->store('products'));

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $data['image'],
            'country' => $data['country'],
            'year' => $data['year'],
            'model' => $data['model'],
            'quantity' => $data['quantity'],
        ]);

        $product->category()->attach(Category::find($data['category']));

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product_create', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'image' => ['image'],
            'country' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'model' => ['required', 'string'],
            'quantity' => ['required', 'integer'],
            'category' => ['required', 'exists:categories,id']
        ]);

        if ($request->has('image')) {
            $data['image'] = str_replace('products/', '', $request->file('image')->store('products'));
        }

        $product->update($data);

        $product->category()->sync(Category::find($data['category']));

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->back();
    }
}
