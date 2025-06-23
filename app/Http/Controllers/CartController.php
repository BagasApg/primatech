<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_exist = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();

        if ($product_exist == null) {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->qty = 1;
            $cart->save();
        } else {
            $product_exist->qty += 1;
            $product_exist->save();
        }

        return redirect()->route('product.index');
    }
}
