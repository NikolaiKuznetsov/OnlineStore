<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(20);

        return view('admin.order', [
            'orders' => $orders,
        ]);
    }

    public function edit($id)
    {
        //
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

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Отменен';
        $order->save();

        return redirect()->back();
    }
}
