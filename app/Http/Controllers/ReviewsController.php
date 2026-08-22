<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;
class ReviewsController extends Controller
{
    public function showAll(Request $request)
    {
        $query = Reviews::with(['post', 'user', 'moderator']);

        // Фильтрация по статусу
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'approved':
                    $query->where('approved', 1);
                    break;
                case 'not_approved':
                    $query->where('approved', 0);
                    break;
                case 'pending':
                    $query->whereNull('moderated_at');
                    break;
                case 'deleted':
                    $query->onlyTrashed();
                    break;
                default:
                    // Все
                    break;
            }
        }

        $reviews = $query->orderBy('created_at', 'desc')->get();

        // Статистика
        $stats = [
            'total' => Reviews::count(),
            'approved' => Reviews::where('approved', 1)->count(),
            'not_approved' => Reviews::where('approved', 0)->count(),
            'pending' => Reviews::whereNull('moderated_at')->count(),
            'deleted' => Reviews::onlyTrashed()->count(),
        ];

        return view('admin.reviews.index', compact('reviews', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'postId' => 'required|exists:posts,id',
            'comment' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $post = Post::findOrFail($request->input('postId'));
        $user = Auth::user();
        $review = new Reviews();
        $review->user_id = $user->id;
        $review->post_id = $post->id;
        $review->comment = $request->input('comment');
        $review->rating = $request->input('rating');
        $review->approved = 0;

        $review->save();
        return redirect()->back()->with('success', 'Отзыв успешно одобрен!');
    }
    public function edit(string $id)
    {
        $review = Reviews::all();
        return view('admin.reviews.edit', compact('review'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'approved' => 'required|boolean|',
            'user_id' => 'required|integer|exists:users,id',
            'post_id' => 'required|integer|extsts:posts,id',
        ]);
    }

    public function softDelete($id)
    {
        $review = Reviews::findOrFail($id);
        $review->delete();

        Log::info('Отзыв удален (soft delete)', [
            'review_id' => $review->id,
            'user_id' => Auth::id(),
            'post_id' => $review->post_id,
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв перемещен в корзину');
    }

    public function restore($id)
    {
        $review = Reviews::withTrashed()->findOrFail($id);
        $review->restore();

        Log::info('Отзыв восстановлен', [
            'review_id' => $review->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв успешно восстановлен');
    }

    // Полное удаление из базы данных
    public function forceDelete($id)
    {
        $review = Reviews::withTrashed()->findOrFail($id);


        if (!$review->trashed()) {
            return back()->with('error', 'Сначала переместите отзыв в корзину');
        }

        $review->forceDelete();

        Log::info('Отзыв полностью удален', [
            'review_id' => $review->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв полностью удален из базы данных');
    }

    public function clearTrash()
    {
        $count = Reviews::onlyTrashed()->count();
        Reviews::onlyTrashed()->forceDelete();

        Log::info('Корзина очищена', [
            'user_id' => Auth::id(),
            'deleted_count' => $count,
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', "Очищено {$count} отзывов из корзины");
    }

    public function cleanOldTrashed()
    {
        $count = Reviews::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(30))
            ->forceDelete();

        return redirect()->route('admin.reviews.index')
            ->with('success', "Удалено {$count} старых отзывов");
    }
    public function approve($id)
    {
        $review = Reviews::findOrFail($id);
        $review->approved = 1;

        $review->rejection_reason = null;
        $review->save();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв успешно одобрен');
    }

    // Отклонение отзыва
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500'
        ]);

        $review = Reviews::findOrFail($id);
        $review->approved = 0;

        $review->rejection_reason = $request->input('rejection_reason');
        $review->save();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв отклонён');
    }

    public function delete($id)
    {
        $review = Reviews::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв удалён');
    }
}
