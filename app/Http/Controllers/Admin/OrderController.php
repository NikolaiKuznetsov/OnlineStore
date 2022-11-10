<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->keys();

        if ($key && $key[0] === 'sort') {
            $value = $request->input($key[0]);
            $orders = Order::whereStatus($value)->orderBy('created_at', 'DESC')->paginate(20);
        } elseif ($key && $key[0] === 'page') {
            $orders = Order::orderBy('created_at', 'DESC')->paginate(20);
        } else {
            $orders = Order::orderBy('created_at', 'DESC')->paginate(20);
        }

        return view('admin.order', [
            'orders' => $orders,
        ]);
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order_show', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Подтвержден';
        $order->save();

        return redirect()->back();
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Отменен';
        $order->comment = $request->comment;
        $order->save();

        return redirect()->back();
    }
}
