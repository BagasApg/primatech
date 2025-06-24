<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where("user_id", Auth::user()->id)->get();
        return view("order", compact("orders"));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_date = Carbon::now();
        $order->total_product = count($cart);
        $order->grand_total = $request->grand_total;
        $order->save();

        foreach ($cart as $item) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item->product_id;
            $order_detail->qty =  $item->qty;
            $order_detail->unit_price = $item->product->price;
            $order_detail->total_price = $item->product->price * $item->qty;

            Cart::destroy($item->id);

            $order_detail->save();
        }

        return redirect()->route('invoice.index', $order->id);
    }
}
