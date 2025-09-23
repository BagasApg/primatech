<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where("user_id", Auth::user()->id)->get();
        return view("order", compact("orders"));
    }

    public function admin_index()
    {
        $orders = Order::get();
        return view('admin.orders.index', compact('orders'));
    }


    public function store(Request $request)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $order = Order::find($request->order_id);
        // dd($order);

        if (count($cart) > 0) {

            // $midtransOrderId = 'ORDER-' . time();

            // $order = new Order();
            // $order->order_id = $midtransOrderId;
            // $order->user_id = Auth::user()->id;
            // $order->order_date = Carbon::now();
            // $order->total_product = count($cart);
            // $order->grand_total = $request->grand_total;
            // $order->confirmation_status = 'waiting';
            // $order->payment_status = 'pending';
            // $order->save();
            // $order = new Order();
            // $order->order_id = $midtransOrderId;
            // $order->user_id = Auth::user()->id;
            // $order->order_date = Carbon::now();
            // $order->total_product = count($cart);
            // $order->grand_total = $request->grand_total;
            // $order->confirmation_status = 'waiting';
            // $order->payment_status = 'pending';
            // $order->save();

            $item_details = [];

            foreach ($cart as $item) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item->product_id;
                $order_detail->qty =  $item->qty;
                $order_detail->unit_price = $item->product->price;
                $order_detail->total_price = $item->product->price * $item->qty;

                Cart::destroy($item->id);

                // add to midtrans
                $item_details[] = [
                    'id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $item->qty,
                    'name' => $item->product->name,
                ];

                $order_detail->save();
            }

            // midtrans configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitazed');
            Config::$is3ds = config('midtrans.is_3ds');

            // create snapToken
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => $request->grand_total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->profile->email
                ],
                'item_details' => $item_details,
            ];

            $snap = Snap::createTransaction($params);
            // dd($snap);

            // save snapToken and payment type
            $order->snap_token = $snap->token;
            $order->payment_type = $snap->payment_type ?? null;
            $order->save();

            // send snaptoken to jquery
            return response()->json([
                'snap_token' => $snap->token,
                'order_id' => $order->order_id,
            ]);
            // return redirect()->route('invoice.index', $order->id);
        } else {
            return redirect()->back();
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $signatureKey = hash(
            'sha512',
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($signatureKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // update payment status
        $transaction = $request->transaction_status;
        $bank = $request->bank;

        if ($transaction === "capture" || $transaction === "settlement") {
            $order->payment_status = 'paid';
        } else if ($transaction === 'pending') {
            $order->payment_status = 'pending';
        } else if (in_array($transaction, ['deny', 'cancel', 'expire'])) {
            $order->payment_status = 'failed';
        }

        $order->payment_type = $bank;
        $order->save();

        return response()->json(['message' => 'Callback processed'], 200);
    }

    public function confirm_order(Request $request, $id)
    {
        $order = Order::find($id);

        if ($request->confirmation == 'approve') {
            $order->confirmation_status = 'confirmed';
        } else if ($request->confirmation == 'reject') {
            $order->confirmation_status = 'canceled';
        }
        $order->save();

        return response()->json(['message' => 'Confirmation'], 200);
    }
}
