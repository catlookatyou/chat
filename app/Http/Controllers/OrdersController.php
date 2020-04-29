<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders', compact('orders'));
    }

    public function new()
    {
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);
        return view('order',[
            'items'=> $cart->items,
            'totalPrice'=> $cart->totalPrice,
            'totalQty'=>$cart->totalQty]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $cart = session()->get('cart');
        //$uuid_temp = str_replace("-", "",substr(Str::uuid()->toString(), 0,18));
        $order = Order::create([
            'name' => request('name'),
            'email' => request('email'),
            'cart' => serialize($cart),
            //'uuid' => $uuid_temp
            ]);
        // session()->flash('success', 'Order success!');
        session()->forget('cart');
        return redirect('/orders');
    }
}
