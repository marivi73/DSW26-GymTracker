<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon_path' => 'nullable|string',
        ]);

        Category::create($request->only('name', 'icon_path'));
        return redirect()->route('categories.index')->with('success', 'Categoría creada');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string',
            'icon_path' => 'nullable|string',
        ]);

        $category->update($request->only('name', 'icon_path'));
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada');
    }
}

