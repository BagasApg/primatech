<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart', compact('carts'));
    }

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

        return redirect()->route('product.index')->with('success', "Successfully added a new item to cart");
    }

    public function updateQty(Request $request) {
        $cart = Cart::findOrFail($request->id);
        if ($request->type == 'plus') {
            $cart->qty += 1;
            $cart->save();

            return response()->json([
                'qty' => $cart->qty,
                'total' => $cart->qty * $cart->product->price,
            ]);
        }

        if ($request->type === 'minus') {
             if ($cart->qty > 1) {
                $cart->qty -= 1;
                $cart->save();

                return response()->json([
                    'qty' => $cart->qty,
                    'total' => $cart->qty * $cart->product->price
                ]);
            } else {
                $cart->delete();

                return response()->json([
                    'id' => $request->id
                ]);
            }
        }

    }

    public function removeItem($id) {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back()->with("success", "Successfully deleted a data");
    }
}
