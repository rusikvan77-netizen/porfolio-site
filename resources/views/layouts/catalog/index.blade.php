@extends('layouts.app')
@section('content')
    <div class="catalog-page">
        <!-- Hero-секция -->
        <section class="catalog-hero">
            <div class="catalog-container">
                <h1 class="catalog-title">🎮 Каталог <span class="catalog-highlight">игр</span></h1>
            </div>
        </section>

        <div class="catalog-container">
            <div class="catalog-layout">
                <!-- Боковая панель с фильтрами -->
                <aside class="catalog-sidebar">
                    <div class="filter-card">
                        <h3>🔍 Фильтры</h3>

                        <!-- Категории -->
                        <div class="filter-group">
                            <h4>Категория</h4>
                            <div class="filter-options">
                                <a href="{{ route('catalog', array_merge(request()->except('category'), ['category' => 'all'])) }}"
                                    class="filter-option {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">
                                    Все
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('catalog', array_merge(request()->except('category'), ['category' => $category->id])) }}"
                                        class="filter-option {{ request('category') == $category->id ? 'active' : '' }}">
                                        {{ $category->icon ?? '🎮' }} {{ $category->nameCategory }}
                                        <span class="option-count">{{ $category->posts->count ?? null }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Жанры -->
                        <div class="filter-group">
                            <h4>Жанр</h4>
                            <div class="filter-options">
                                <a href="{{ route('catalog', array_merge(request()->except('genre'), ['genre' => 'all'])) }}"
                                    class="filter-option {{ !request('genre') || request('genre') == 'all' ? 'active' : '' }}">
                                    Все
                                </a>
                                @foreach($genres as $genre)
                                    <a href="{{ route('catalog', array_merge(request()->except('genre'), ['genre' => $genre->id])) }}"
                                        class="filter-option {{ request('genre') == $genre->id ? 'active' : '' }}">
                                        {{ $genre->icon ?? '🎮' }} {{ $genre->nameGenre }}
                                        <span class="option-count">{{ $genre->posts_count ?? 0 }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Цена -->
                        <div class="filter-group">
                            <h4>Цена</h4>
                            <div class="price-range">
                                <div class="price-inputs">
                                    <input type="number" id="price_min" placeholder="От" value="{{ request('price_min') }}">
                                    <span>—</span>
                                    <input type="number" id="price_max" placeholder="До" value="{{ request('price_max') }}">
                                </div>
                                <button class="price-apply" onclick="applyPriceFilter()">Применить</button>
                            </div>
                        </div>

                        <!-- Сортировка -->
                        <div class="filter-group">
                            <h4>Сортировка</h4>
                            <div class="sort-options">
                                <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'new'])) }}"
                                    class="sort-option {{ request('sort') == 'new' || !request('sort') ? 'active' : '' }}">
                                    🆕 По новизне
                                </a>
                                <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}"
                                    class="sort-option {{ request('sort') == 'price_asc' ? 'active' : '' }}">
                                    💰 По возрастанию цены
                                </a>
                                <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}"
                                    class="sort-option {{ request('sort') == 'price_desc' ? 'active' : '' }}">
                                    💰 По убыванию цены
                                </a>
                                <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'popular'])) }}"
                                    class="sort-option {{ request('sort') == 'popular' ? 'active' : '' }}">
                                    ⭐ По популярности
                                </a>
                                <a href="{{ route('catalog', array_merge(request()->except('sort'), ['sort' => 'rating'])) }}"
                                    class="sort-option {{ request('sort') == 'rating' ? 'active' : '' }}">
                                    ⭐ По рейтингу
                                </a>
                            </div>
                        </div>

                        <!-- Сброс фильтров -->
                        <a href="{{ route('catalog') }}" class="reset-filters">
                            <i class="fas fa-undo"></i> Сбросить все фильтры
                        </a>
                    </div>
                </aside>

                <!-- Основная часть с играми -->
                <main class="catalog-main">
                    <!-- Выбранные фильтры (хлебные крошки) -->
                    <div class="active-filters">
                        @if(request('category') && request('category') != 'all')
                            <span class="filter-tag">
                                {{ $categories->firstWhere('id', request('category'))->nameCategory ?? '' }}
                                <a href="{{ route('catalog', array_merge(request()->except('category'), ['category' => 'all'])) }}"
                                    class="remove-filter">✕</a>
                            </span>
                        @endif
                        @if(request('genre') && request('genre') != 'all')
                            <span class="filter-tag">
                                {{ $genres->firstWhere('id', request('genre'))->nameGenre ?? '' }}
                                <a href="{{ route('catalog', array_merge(request()->except('genre'), ['genre' => 'all'])) }}"
                                    class="remove-filter">✕</a>
                            </span>
                        @endif
                        @if(request('price_min') || request('price_max'))
                            <span class="filter-tag">
                                {{ request('price_min') ? 'от ' . request('price_min') : '' }}
                                {{ request('price_max') ? 'до ' . request('price_max') : '' }} ₽
                                <a href="{{ route('catalog.index', array_merge(request()->except(['price_min', 'price_max']))) }}"
                                    class="remove-filter">✕</a>
                            </span>
                        @endif
                        @if(request('sort'))
                            <span class="filter-tag">
                                {{ request('sort') == 'new' ? 'Новинки' : '' }}
                                {{ request('sort') == 'price_asc' ? 'Цена ↑' : '' }}
                                {{ request('sort') == 'price_desc' ? 'Цена ↓' : '' }}
                                {{ request('sort') == 'popular' ? 'Популярные' : '' }}
                                {{ request('sort') == 'rating' ? 'По рейтингу' : '' }}
                                <a href="{{ route('catalog', array_merge(request()->except('sort'))) }}"
                                    class="remove-filter">✕</a>
                            </span>
                        @endif
                    </div>

                    <!-- Количество найденных игр -->
                    <div class="results-count">
                        Найдено: <strong>{{ $posts->total() }}</strong> игр
                    </div>

                    <!-- Сетка игр -->
                    <div class="products-grid">
                        @forelse($posts as $post)
                            <div class="product-card" data-category="{{ $post->category_id ?? 'all' }}">
                                <div class="product-badge">
                                    @if($post->created_at && $post->created_at->diffInDays(now()) < 7)
                                        <span class="badge-new">🎮 Новинка</span>
                                    @endif
                                    @if($post->price < 1000)
                                        <span class="badge-sale">🔥 -30%</span>
                                    @endif
                                </div>

                                <a href="{{ route('CardPost', $post->id) }}" class="product-link">
                                    <div class="product-image">
                                        <img src="{{ asset($post->img) }}" alt="{{ $post->name }}">
                                        <div class="product-overlay">
                                            <span class="overlay-text">
                                                <i class="fas fa-play"></i> Подробнее
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-name">{{ $post->name }}</h3>
                                        <div class="product-meta">
                                            <span class="product-category">
                                                {{ $post->category ? $post->category->nameCategory : 'Без жанра' }}
                                            </span>
                                            <div class="product-rating">
                                                <i class="fas fa-star"></i>
                                                <span>{{ number_format($post->reviews->avg('rating') ?? 4.5, 1) }}</span>
                                                <span class="reviews-count">({{ $post->reviews->count() }})</span>
                                            </div>
                                        </div>
                                        <p class="product-description">{{ Str::limit($post->description, 60) }}</p>
                                        <div class="product-footer">
                                            <span class="product-price">{{ number_format($post->price, 0, '', ' ') }} ₽</span>
                                            <button class="btn-buy" data-id="{{ $post->id }}">
                                                <i class="fas fa-shopping-cart"></i>
                                                Купить
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">🎮</div>
                                <h3>Игры не найдены</h3>
                                <p>Попробуйте изменить фильтры или вернуться позже</p>
                                <a href="{{ route('catalog') }}" class="empty-btn">Сбросить фильтры</a>
                            </div>
                        @endforelse
                    </div>


                </main>
            </div>
        </div>
    </div>
@endsection