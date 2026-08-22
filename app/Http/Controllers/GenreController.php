<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
    public function showAll()
    {
        $genre = Genre::all();
        return view('admin.genre.index', compact('genre'));
    }
    public function create()
    {
        $genre = Genre::all();
        return view('.admin.genre.create', compact('genre'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nameGenre' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
        ]);
        $genre = new Genre();
        $genre->nameGenre = $request->input('nameGenre');
        $genre->description = $request->input('description');
        $genre->save();
        return redirect()->route('admin.genre.index')->with('success', 'Жанр успешно добавлен');
    }
    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nameGenre' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
        ]);
        $genre = Genre::findOrFail($id);
        $genre->nameGenre = $request->input('nameGenre');
        $genre->description = $request->input('description');
        $genre->save();
        return redirect()->route('admin.genre.index')->with('success', 'Жанр успешно обновлён');
    }
    public function delete(string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->route('admin.genre.index')->with('success', 'Жанр успешно удалён');
    }
}
