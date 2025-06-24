<?php

namespace App\Http\Controllers;

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
}
