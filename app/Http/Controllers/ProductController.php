<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->when($request->search, 
            function($query, $search) {
                $query->where('product_name', 'like', "%{$search}%")->orWhereHas('category', 
                    function($catQuery) use ($search) {
                        $catQuery->where('category_name', 'like', "%{$search}%");
                    }
                );
            }
        )->get();
        
        $categories = Category::All();
        return view('admin.product', compact('products', 'categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:50|unique:products',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'nullable|in:active,inactive'
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $request->file('image') ? $request->file('image')->store('products', 'public') : null,
            'status' => $request->status
        ]);

        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product')->with('success', 'Product deleted successfully.');
    }
}
