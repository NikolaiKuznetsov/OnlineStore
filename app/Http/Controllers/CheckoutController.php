<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $carts = Cart::get()->map(function ($cart) {
            return $cart;
        });
        $products = Cart::get()->map(function ($cart) {
            return $cart->product()->first();
        });

        return view('checkout', [
            'products' => $products,
            'carts' => $carts,
            'count' => Cart::count(),
            'total' => Cart::total(),
        ]);
    }

    public function addCheckout(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product->quantity === 0) {
            return Response::json(['errors' => 'Данный товар закончился']);
        }

        $product->quantity--;
        $product->save();

        Cart::add($request->product_id);
    }

    public function changeQuantity(Request $request)
    {
        $cart = Cart::findOrFail($request->id);

        if($cart->quantity === 1) {
            Cart::remove($request->id);
        }

        $cart->product->quantity++;
        $cart->quantity--;
        $cart->product->save();
        $cart->save();
    }

    public function saveOrder(Request $request)
    {
        $data = $request->validate([
            'password' => ['required'],
        ]);

        $cart_products = Cart::get();

        if (!$cart_products->first()) {
            return Response::json(['errors' => ['password' => ['Корзина пуста']]], 422);
        }
        if (!Hash::check($data['password'], Auth::user()->getAuthPassword())) {
            return Response::json(['errors' => ['password' => ['Пароль введен не верно']]], 422);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'Новый',
        ]);

        foreach ($cart_products as $cart_product) {
            $order->item()->create([
                'product_id' => $cart_product->product_id,
                'price' => $cart_product->price * $cart_product->quantity,
                'quantity' => $cart_product->quantity,
                'order_id' => $order->id,
            ]);
            Cart::remove($cart_product->id);
        }

        return redirect()->back();
    }

    public function showSuccess()
    {
        return view('basket.success');
    }
}
