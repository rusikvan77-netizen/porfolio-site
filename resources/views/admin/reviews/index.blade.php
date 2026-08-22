<!-- resources/views/admin/reviews/index.blade.php -->
@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="btn-group mb-3 flex-wrap">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-primary">Все</a>
                        <a href="{{ route('admin.reviews.index', ['filter' => 'approved']) }}"
                            class="btn btn-outline-success">Одобренные</a>
                        <a href="{{ route('admin.reviews.index', ['filter' => 'not_approved']) }}"
                            class="btn btn-outline-danger">Не одобренные</a>
                        <a href="{{ route('admin.reviews.index', ['filter' => 'pending']) }}"
                            class="btn btn-outline-warning">На проверке</a>
                        <a href="{{ route('admin.reviews.index', ['filter' => 'deleted']) }}"
                            class="btn btn-outline-secondary">В корзине</a>
                    </div>

                    @if(request('filter') == 'deleted')
                        <form action="{{ route('admin.reviews.clear-trash') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Очистить корзину полностью?')">
                                <i class="fas fa-trash-alt"></i> Очистить корзину
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon fa fa-check"></i> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="icon fa fa-times"></i> {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Пост</th>
                                        <th>Пользователь</th>
                                        <th>Комментарий</th>
                                        <th>Рейтинг</th>
                                        <th>Статус</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reviews as $review)
                                        <tr
                                            class="{{ $review->trashed() ? 'table-secondary text-muted' : ($review->approved == 0 ? 'table-warning' : '') }}">
                                            <td>{{ $review->id }}</td>
                                            <td>
                                                @if($review->post)
                                                    <a href="{{ route('CardPost', $review->post->id) }}" target="_blank">
                                                        {{ $review->post->name }}
                                                    </a>
                                                @else
                                                    <span class="text-danger">Удалён</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($review->user)
                                                    {{ $review->user->name }}
                                                @else
                                                    <span class="text-muted">Удалён</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div style="max-width: 200px; max-height: 50px; overflow: hidden;">
                                                    {{ Str::limit($review->comment, 50) }}
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $review->rating >= 4 ? 'success' : ($review->rating >= 3 ? 'warning' : 'danger') }}">
                                                    {{ $review->rating }} / 5
                                                </span>
                                            </td>
                                            <td>
                                                @if($review->trashed())
                                                    <span class="badge badge-secondary">🗑️ В корзине</span>
                                                @elseif($review->approved == 1)
                                                    <span class="badge badge-success">✅ Одобрен</span>
                                                @elseif($review->moderated_at)
                                                    <span class="badge badge-danger">❌ Отклонён</span>
                                                @else
                                                    <span class="badge badge-warning">⏳ На проверке</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($review->trashed())
                                                    <form action="{{ route('admin.reviews.restore', $review->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success" title="Восстановить">
                                                            <i class="fas fa-undo"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.reviews.force-delete', $review->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Удалить безвозвратно?')"
                                                            title="Удалить навсегда">
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    @if($review->approved == 0 && !$review->moderated_at)
                                                        <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-success" title="Одобрить">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if($review->approved == 1)
                                                        <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-warning" title="Отклонить">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <a href="{{ route('admin.reviews.edit', $review->id) }}"
                                                        class="btn btn-sm btn-primary" title="Редактировать">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.reviews.soft-delete', $review->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-secondary"
                                                            onclick="return confirm('Переместить в корзину?')" title="В корзину">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-3">
                                                Отзывов не найдено
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection