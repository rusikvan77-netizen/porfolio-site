<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CatalogController;

Route::get('/dashboard', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/logout', [ProfileController::class, 'logout']);
Route::post('/logout', [ProfileController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== ПУБЛИЧНЫЕ МАРШРУТЫ =====

Route::get('/', [PostController::class, 'index'])->name('FirstPage');
Route::get('/FirstPage', [PostController::class, 'index']);
Route::get('/showPost/{id}', [PostController::class, 'show'])->name('CardPost');
Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/faq', function () {
    return view('layouts.faq');
});
Route::get('/aboutUs', function () {
    return view('layouts.aboutUs');
});
Route::get('/contacs', function () {
    return view('layouts.contacs');
});
// ===== АДМИН-МАРШРУТЫ =====
Route::prefix('admin')->name('admin.')->group(function () {

    // Главная админ-панели
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // ===== ПОСТЫ =====
    Route::get('/posts', [PostController::class, 'showAll'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('posts.delete');

    // ===== КАТЕГОРИИ =====
    Route::get('/category', [CategoryController::class, 'showAll'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // ===== ЖАНРЫ =====
    Route::get('/genre', [GenreController::class, 'showAll'])->name('genre.index');
    Route::get('/genre/create', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/genre', [GenreController::class, 'store'])->name('genre.store'); // Исправлено: было /gente/store
    Route::get('/genre/{id}/edit', [GenreController::class, 'edit'])->name('genre.edit');
    Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/{id}', [GenreController::class, 'delete'])->name('genre.delete'); // Исправлено: был другой формат

    // ===== ОТЗЫВЫ (ВСЕ МАРШРУТЫ) =====
    Route::get('/reviews', [ReviewsController::class, 'showAll'])->name('reviews.index');
    Route::get('/reviews/{id}/edit', [ReviewsController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewsController::class, 'update'])->name('reviews.update');

    // ДОБАВЛЯЕМ НЕДОСТАЮЩИЕ МАРШРУТЫ:
    Route::patch('/reviews/{id}/approve', [ReviewsController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{id}/reject', [ReviewsController::class, 'reject'])->name('reviews.reject');
    Route::delete('/reviews/{id}', [ReviewsController::class, 'delete'])->name('reviews.delete');

    // Soft delete маршруты
    Route::delete('/reviews/{id}/soft-delete', [ReviewsController::class, 'softDelete'])->name('reviews.soft-delete');
    Route::patch('/reviews/{id}/restore', [ReviewsController::class, 'restore'])->name('reviews.restore');
    Route::delete('/reviews/{id}/force-delete', [ReviewsController::class, 'forceDelete'])->name('reviews.force-delete');
    Route::delete('/reviews/clear-trash', [ReviewsController::class, 'clearTrash'])->name('reviews.clear-trash');
    Route::delete('/reviews/clean-old', [ReviewsController::class, 'cleanOldTrashed'])->name('reviews.clean-old');
});

require __DIR__ . '/auth.php';