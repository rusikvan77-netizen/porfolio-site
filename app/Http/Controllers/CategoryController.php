<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('layouts.firstpage', compact('categories'));
    }
    public function showAll()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        $category = Category::all();
        return view('admin.category.create', compact('category'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nameCategory' => 'required|string|max:255',
        ]);
        $category = new Category();
        $category->nameCategory = $request->input('nameCategory');
        $category->save();
        return redirect()->route('admin.category.index')->with('success', 'Категория успешно создана');
    }
    public function edit(string $id)
    {
        $category = Category::findOrfail($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nameCategory' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->nameCategory = $request->input('nameCategory');
        $category->save();
        return redirect()->route('admin.category.index')->with('success', 'Категория успешно обновлена');
    }
    public function delete(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Категория успешно удалена');
    }
}
