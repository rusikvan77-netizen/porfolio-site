<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Post;
use App\Models\Category;
class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'genre', 'reviews']);

        // Фильтр по категории
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // Фильтр по жанру
        if ($request->has('genre') && $request->genre != 'all') {
            $query->where('genre_id', $request->genre);
        }

        // Фильтр по цене
        if ($request->has('price_min') && $request->price_min != '') {
            $query->where('price', '>=', (float) $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max != '') {
            $query->where('price', '<=', (float) $request->price_max);
        }

        // Сортировка
        switch ($request->sort) {
            case 'new':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'rating':
                $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $posts = $query->paginate();
        $categories = Category::withCount('post')->get();
        $genres = Genre::withCount('posts')->get();

        return view('layouts.catalog.index', compact('posts', 'categories', 'genres'));
    }
}
