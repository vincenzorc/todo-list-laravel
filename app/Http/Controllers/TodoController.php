<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();

        return view('todo.index', compact('todos', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        return view('todo.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->update();

        return redirect()->route('todos')->with('success', 'tarea actualizada');
    }

    public function destroy(Todo $todo)
    {
        $todo = Todo::find($todo->id);
        $todo->delete();

        return redirect()->route('todos')->with('success', 'tarea eliminada');
    }
}
