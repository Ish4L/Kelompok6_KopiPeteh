<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        )->orderBy('id', 'asc')->get();
        
        $categories = Category::orderBy('id', 'asc')->get();

        return view('admin.product', compact('products', 'categories'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:50|unique:products,product_name',
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            $fileName = Str::slug($request->product_name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            
            $imagePath = $file->storeAs('products', $fileName, 'public');
        }

        Product::create([
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
            'price'        => $request->price,
            'description'  => $request->description,
            'image'        => $imagePath,
            'status'       => $request->has('status') ? 'active' : 'inactive',
        ]);

        return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan');
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
        $request->validate([
            'product_name' => 'required|string|max:50|unique:products,product_name,' . $product->id,
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $file = $request->file('image');
            
            $fileName = Str::slug($request->product_name) . '-' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            
            $imagePath = $file->storeAs('products', $fileName, 'public');
        }

        $product->update([
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
            'price'        => $request->price,
            'description'  => $request->description,
            'image'        => $imagePath,
            'status'       => $request->has('status') ? 'active' : 'inactive',
        ]);

        return redirect()->route('product')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('product')->with('success', 'Produk berhasil dihapus');
    }
}
