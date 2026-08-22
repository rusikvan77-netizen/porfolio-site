@extends('layouts.app')

@section('content')
    <div class="BLOG">
        <div class="cardChoosed">

            <div class="cardTop">

                <div class="imgBodyChoosed">
                    <img class="choosedImg" src="{{ asset($postId->img) }}" alt="logoCard">
                </div>

                <div class="detailsChoosed">
                    <h2>{{ $postId->name }}</h2>

                    <p class="textp">
                        <b>О товаре</b> <br><br> {{ $postId->description }}
                    </p>

                    @php
                        $avgRating = $postId->reviews->avg('rating') ?? 0;
                        $fullStars = floor($avgRating);
                        $hasHalfStar = $avgRating - $fullStars >= 0.5;
                    @endphp

                </div>

            </div>

            <div class="review-form-wrapper">
                <h3>Ваша оценка</h3>

                @auth
                    <div class="review-form">
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="postId" value="{{ $postId->id }}">

                            <div class="form-group">
                                <label for="rating" class="form-label">Выберите оценку</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="" disabled selected>Выберите оценку</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'звезда' : ($i < 5 ? 'звезды' : 'звёзд') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="form-label">Ваш отзыв</label>
                                <textarea name="comment" id="comment" class="form-control" rows="4" required
                                    placeholder="Поделитесь вашим мнением о товаре..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                        </form>
                    </div>
                @else
                    <div class="alert">
                        <p>Чтобы оставить отзыв, пожалуйста <a href="{{ route('login') }}">войдите</a> или <a
                                href="{{ route('register') }}">зарегистрируйтесь</a>.</p>
                    </div>
                @endauth
            </div>

            <div class="reviewsBottom">
                <div class="rating-text">
                    Средняя оценка: {{ number_format($avgRating, 1) }} из 5 ({{ $postId->reviews->count() }} отзывов)
                </div>
                <h2>Отзывы</h2>

                @if($postId->reviews->count() > 0)
                    @foreach ($postId->reviews as $review)
                        <div class="review-card">
                            <div class="review-header">
                                <span class="review-user">{{ $review->user->name }}</span>
                                <span class="review-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                            </div>
                            <div class="review-content">
                                <p>{{ $review->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="no-reviews">
                        <p>Пока нет отзывов. Будьте первым!</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection