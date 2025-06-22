<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request){

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

        if($request->has('preview')){
            return view('invoice', $data);
        }
        
        $pdf = Pdf::loadView('invoice', $data);

        return $pdf->stream($data['userid']  . "-invoice.pdf");
        
        // return view('invoice', $data);
    }
    
    // $pdf Pdf::load
}
