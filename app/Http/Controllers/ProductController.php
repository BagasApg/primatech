<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $categories = Category::get();

        return view('products', compact('products', 'categories'));
    }

    public function admin()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(){
        $categories = Category::get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);
        // dd($request);

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

        return redirect()->route('admin.product.index')->with('success', "Successfully added a new product");
    }

    public function show(Product $product){
        // $product = Product::find($id);
        $categories = Category::get(); 

        // dd($product);

        return view('admin.products.show', compact('product', 'categories'));
    }

    public function edit($id){
        $product = Product::find($id);
        $categories = Category::get();
        // dd($categories);

        return view('admin.products.edit', compact('product', 'categories'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);

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

        return redirect()->route('admin.product.index')->with('success', "Successfully edited a product");
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        // dd($product);
        
        // Image deletion
        if($product->image){
            // Get full path
            $image_path = public_path('images/') . $product->image;
            // dd($image_path);

            File::delete($image_path);
        }

        // if this  product is in cart, delete it.
        Cart::where("product_id", $id)->each(function ($cart) {
            $cart->delete();
        });

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', "Successfully deleted a product");
    }
}
