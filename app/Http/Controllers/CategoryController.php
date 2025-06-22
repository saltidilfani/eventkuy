<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('events')->latest('id')->paginate(10);
        return view('admin.categories.daftar', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:salti_categories,name',
        ]);

        // Penyempurnaan: Langsung menggunakan $request->all() jika field di form sama dengan di database
        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Penyempurnaan: Menggunakan Route Model Binding (Category $category)
    public function edit(Category $category)
    {
        return view('admin.categories.ubah', compact('category'));
    }

    // Penyempurnaan: Menggunakan Route Model Binding (Category $category)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:salti_categories,name,' . $category->id,
        ]);

        // Penyempurnaan: Langsung menggunakan $request->all()
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    // Penyempurnaan: Menggunakan Route Model Binding (Category $category)
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}