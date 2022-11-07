<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showUser()
    {
        $user = User::find(Auth::id());
        $orders = $user->order()->orderBy('created_at', 'DESC')->get();

        return view('order', [
            'orders' => $orders,
        ]);
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if ($user->id !== $order->user_id) {
            return redirect()->back();
        }

        $order->delete();

        return redirect()->back();
    }
}
