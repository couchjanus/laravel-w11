<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }
    public function ship(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Ship order...

        Mail::to($request->user())->send(new OrderShipped($order));
        return redirect()->route('order.index')->with('success','Your Order Ship Sended Successfully.');
    }
}
