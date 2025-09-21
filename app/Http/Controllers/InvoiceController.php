<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(Request $request, $id)
    {
        $order = Order::where("order_id", $id)->first();
        $order_details = $order->order_details()->get();

        view()->share([
            'order' => $order,
            'order_details' => $order_details,
            'user' => Auth::user(),
        ]);

        $pdf = Pdf::loadView('invoice');

        return $pdf->stream($order['userid']  . "-invoice.pdf");

        return view('invoice');
    }

    // $pdf Pdf::load
}
