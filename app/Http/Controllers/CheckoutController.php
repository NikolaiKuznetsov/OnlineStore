<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return Response::json(['error' => 'Данный товар закончился']);
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

        if (!$cart_products) {
            return Response::json(['error' => 'Корзина пуста']);
        }
        if (!auth('web')->once(['login' => $request->session()->has('login'), 'password' => $data->password])) {
            return Response::json(['error' => 'Пароль введен не верно']);
        }

        $order = Order::query()->create([
            'user_id' => Auth::id(),
            'status' => 'Создан',
        ]);

        foreach ($cart_products as $cart_product) {
            $order->items()->create([
                'product_id' => $cart_product->id,
                'price' => $cart_product->price,
                'quantity' => $cart_product->quantity,
            ]);
        }

        $cart_products->delete();

        return redirect()->route('basket.success')->with('success', 'Ваш заказ успешно размещен');
    }
}
