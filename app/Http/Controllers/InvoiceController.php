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

        $data = [
            'userid' => "0301209",
            'name' => "Bagas Arianto",
            'address' => "Jl. Ngagel Rejo Kidul",
            'phone' => '085158192',
            'tanggal' => '15 Juni 2025',
            'paypal' => '1293912',
            'bank' => "Mandiri",
            'payment' => 1
        ];

        if ($request->has('preview')) {
            return view('invoice', $data);
        }

        $order = Order::where("order_id", $id)->first();
        $order_details = $order->order_details()->get();

        view()->share([
            'order' => $order,
            'order_details' => $order_details,
            'user' => Auth::user(),
        ]);

        $pdf = Pdf::loadView('invoice', $data);

        return $pdf->stream($data['userid']  . "-invoice.pdf");

        // return view('invoice', $data);
    }

    // $pdf Pdf::load
}
