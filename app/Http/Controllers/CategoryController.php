<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success','Nueva categoria agregada');
    }

    public function show(string $id)
    {
        $category = Category::find($id);

        return view('categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->color = $request->color;
        $category->update();

        return redirect()->route('categories.index')->with('success','categoria actualizada');
    }
    
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->todos->each(function ($todo) {
            $todo->delete();
        });
        $category->delete();

        return redirect()->route('categories.index')->with('success','categoria eliminada');
    }
}
