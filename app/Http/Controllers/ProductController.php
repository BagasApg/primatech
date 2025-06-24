<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $categories = Category::get();

        return view('products', compact('products', 'categories'));
    }

    public function showProduct()
    {
        return view('product');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|max:50|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|files|image|mimes:jpeg,jpg,png',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // image handler
        $file_name = time() . "_" . $request->file('image')->getClientOriginalName();
        $request->file('image')->move('images', $file_name);

        $product->image = $file_name;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', "Successfully add new product");
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // image handler
        $file_name = time() . "_" . $request->file('image')->getClientOriginalName();
        $request->file('image')->move('images', $file_name);

        $product->image = $file_name;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', "Successfully edit product");
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        // if this product in cart, delete it.
        Cart::where("product_id", $id)->each(function ($cart) {
            $cart->delete();
        });

        $product->delete();

        return redirect()->route('admin.panel.index')->with('success', "Successfully delete product");
    }
}
