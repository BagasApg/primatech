<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function admin(){
        $categories = Category::withCount('products')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);
        
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', "Successfully added a new category");
    }

    public function show(Category $category){
        $products = Product::where('category_id', '=', $category->id)->get();
        return view('admin.categories.show', compact('category', 'products'));
    }

    public function edit($id){
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', "Successfully edited " . $request->name . " category");
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $name = $category->name;
        $category->delete();

        Product::where('category_id', $id)->each(function ($p){
            $p->delete();
        });

        return redirect()->route('admin.category.index')->with('success', "Successfully ". $name ." category");
    }
}
