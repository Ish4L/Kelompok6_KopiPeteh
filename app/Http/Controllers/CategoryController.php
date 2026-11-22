<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search, 
            function ($query, $search) {
                $query->where('category_name', 'like', "%{$search}%");
            }
        )->orderBy('id', 'asc')->get();

        return view('admin.category', compact('categories'));
    }

    public function create()
    {
        // return view('admin.categorycreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:50|unique:categories,category_name',
        ], [
            'category_name.required' => 'Field wajib diisi',
            'category_name.unique' => 'Nama kategori sudah ada',
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('category')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->id,
        ]);

        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('category')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()->route('category')->with('error', 'Kategori masih digunakan oleh produk');
        }

        $category->delete();

        return redirect()->route('category')->with('success', 'Kategori berhasil dihapus.');
    }
}
