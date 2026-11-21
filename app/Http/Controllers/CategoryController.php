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
        )->get();

        return view('admin.category', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:50',
        ]);

        Category::create(['category_name' => $request->category_name]);
        return redirect()->route('category')->with('success', 'Kategori berhasil ditambahkan.');
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
        //
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category')->with('success', 'Category deleted successfully.');
    }
}
