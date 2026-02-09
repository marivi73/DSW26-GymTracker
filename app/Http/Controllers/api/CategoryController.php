<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function exercises(Category $category)
    {
        return $category->exercises;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'icon_path' => 'nullable|string',
        ]);

        return Category::create($request->only('name', 'icon_path'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->only('name', 'icon_path'));
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
