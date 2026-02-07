<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     // GET /categories
    public function index()
    {
        return Category::all();
    }

    // GET /categories/{id}
    public function show(Category $category)
    {
        return $category;
    }

    // POST /categories
    public function store(Request $request)
    {
        return Category::create($request->only('name', 'icon_path'));
    }

    // PUT /categories/{id}
    public function update(Request $request, Category $category)
    {
        $category->update($request->only('name', 'icon_path'));
        return $category;
    }

    // DELETE /categories/{id}
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }

    // GET /categories/{id}/exercises
    public function exercises(Category $category)
    {
        return $category->exercises;
    }
}
