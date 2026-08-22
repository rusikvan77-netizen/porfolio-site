<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Reviews;
use App\Models\Genre;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category');

        // Фильтр по категории/жанру
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // Фильтр по статусу (новинки, скидки, популярные)
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'new':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
                case 'sale':
                    $query->where('price', '<', 1000); // или есть поле discount
                    break;
                case 'popular':
                    $query->orderBy('views', 'desc'); // или по продажам
                    break;
            }
        }

        $posts = $query->get();
        $genres = Genre::whereIn('id', [2,3,10,11])->get();
        $categories = Category::all();

        return view('layouts.firstpage', compact('posts', 'categories', 'genres'));
    }

    public function show($id)
    {
        $postId = Post::with([
            'reviews.user',
            'category',
            'reviews' => function ($query) {
                $query->where('approved', 1);
            },
            'reviews.user'
        ])->findOrFail($id);
        return view('post.show', compact('postId'));
    }

    public function showAll()
    {
        $posts = Post::with('category')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $category = Category::all();
        $post = Post::all();
        return view('admin.posts.create', compact('post', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'description' => 'required|string|max:5000',
            'category_id' => 'required|exists:Category,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $post = new Post();
        $post->name = $request->input('name');
        $post->price = $request->input('price');
        $post->description = $request->input('description');
        $post->category_id = $request->category_id;

        $uploadDir = public_path('image/posts/');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($uploadDir, $filename);
        $post->img = 'image/posts/' . $filename;

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно создан');
    }

    public function edit(string $id)
    {
        $genre = Genre::all();
        $category = Category::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post', 'category', 'genre'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'description' => 'required|string|max:5000',
            'category_id' => 'required|exists:Category,id',
            'genre_id' => 'required|exists:Genre,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $post = Post::findOrFail($id);
        $post->name = $request->input('name');
        $post->price = $request->input('price');
        $post->description = $request->input('description');
        $post->category_id = $request->category_id;
        $post->genre_id = $request->genre_id;

        if ($request->hasFile('image')) {
            $uploadDir = public_path('image/posts/');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadDir, $filename);

            // Удаляем старый файл, если он был загружен ранее
            if ($post->img && file_exists(public_path($post->img))) {
                unlink(public_path($post->img));
            }

            $post->img = 'image/posts/' . $filename;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно обновлён');
    }

    public function delete(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->img && file_exists(public_path($post->img))) {
            unlink(public_path($post->img));
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно удалён');
    }
}
