<!-- resources/views/layouts/firstpage.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Hero-секция -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Погрузись в мир <br>
                    <span class="hero-highlight">видеоигр</span>
                </h1>
                <p class="hero-description">
                    Огромный выбор видеоигр для PlayStation, Xbox, Nintendo Switch и PC.
                    Лицензионные ключи, мгновенная доставка, лучшие цены.
                </p>
                <div class="hero-buttons">
                    <a href="#catalog" class="hero-btn primary">
                        <i class="fas fa-gamepad"></i> В каталог
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Игр</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">150K</span>
                        <span class="stat-label">Геймеров</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.8</span>
                        <span class="stat-label">Средний рейтинг</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img class="prophet" src="{{ asset('image/cf00d5f6-3336-45d0-8b08-768f435230c0.jpeg') }}" alt="Prophet"
                    class="hero-img">
            </div>
        </div>
    </section>

    <!-- Платформы -->
    <section class="platforms-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🎯 Выбери свою платформу</h2>
                <a href="#" class="section-link">Все платформы →</a>
            </div>
            <div class="platforms-grid">
                <a href="#" class="platform-card">
                    <div class="platform-icon">
                        <i class="fab fa-playstation"></i>
                    </div>
                    <span class="platform-name">PlayStation</span>
                    <span class="platform-count">250+ игр</span>
                </a>
                <a href="#" class="platform-card">
                    <div class="platform-icon">
                        <i class="fab fa-xbox"></i>
                    </div>
                    <span class="platform-name">Xbox</span>
                    <span class="platform-count">200+ игр</span>
                </a>
                <a href="#" class="platform-card">
                    <div class="platform-icon">
                        <i class="fab fa-vk"></i>
                    </div>
                    <span class="platform-name">Вконтакте</span>
                    <span class="platform-count">150+ игр</span>
                </a>
                <a href="#" class="platform-card">
                    <div class="platform-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <span class="platform-name">PC</span>
                    <span class="platform-count">400+ игр</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Категории игр -->
    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🎮 Жанры игр</h2>
                <a href="{{ route('FirstPage') }}" class="section-link {{ !request('genre') ? 'active' : '' }}">
                    Все жанры →
                </a>
            </div>
            <div class="categories-grid">
                @foreach($genres as $genre)
                    <a href="{{ route('FirstPage', ['genre' => $genre->id]) }}"
                        class="category-card {{ request('genre') == $genre->id ? 'active' : '' }}">
                        <span class="category-name">{{ $genre->nameGenre }}</span>
                        <span class="category-count">{{ $genre->posts->count() }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Каталог игр -->
    <section class="catalog-section" id="catalog">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🔥 Наши игры</h2>
                <div class="section-controls">
                    <a class="filter-btn" href="{{ route('catalog') }}">Каталог</a>

                    <a href="{{ route('FirstPage') }}" class="filter-btn {{ !request('filter') ? 'active' : '' }}">
                        Все
                    </a>
                    <a href="{{ route('FirstPage', array_merge(request()->all(), ['filter' => 'new'])) }}"
                        class="filter-btn {{ request('filter') == 'new' ? 'active' : '' }}">
                        Новинки
                    </a>
                    <a href="{{ route('FirstPage', array_merge(request()->all(), ['filter' => 'sale'])) }}"
                        class="filter-btn {{ request('filter') == 'sale' ? 'active' : '' }}">
                        Скидки
                    </a>
                    <a href="{{ route('FirstPage', array_merge(request()->all(), ['filter' => 'popular'])) }}"
                        class="filter-btn {{ request('filter') == 'popular' ? 'active' : '' }}">
                        Популярные
                    </a>
                </div>
            </div>

            <div class="products-grid">
                @forelse($posts as $post)
                    <div class="product-card" data-category="{{ $post->category_id ?? 'all' }}">
                        <!-- Бейджи -->
                        <div class="product-badge">
                            @if($post->created_at->diffInDays(now()) < 7)
                                <span class="badge-new">🎮 Новинка</span>
                            @endif
                            @if($post->price < 1000)
                                <span class="badge-sale">🔥 -30%</span>
                            @endif
                        </div>

                        <a href="{{ route('CardPost', $post->id) }}" class="product-link">
                            <div class="product-image">
                                <img src="{{ asset($post->img) }}" alt="{{ $post->name }}">
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
                        <p>Попробуйте изменить фильтр или вернуться позже</p>
                        <a href="{{ route('FirstPage') }}" class="empty-btn">Сбросить фильтр</a>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- Преимущества -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Мгновенная доставка</h3>
                    <p class="feature-desc">Получите ключ игры на email сразу после оплаты</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛡️</div>
                    <h3 class="feature-title">Гарантия ключей</h3>
                    <p class="feature-desc">Только лицензионные ключи от официальных дистрибьюторов</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3 class="feature-title">Обмен и возврат</h3>
                    <p class="feature-desc">Возврат средств в течение 14 дней</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <h3 class="feature-title">Удобная оплата</h3>
                    <p class="feature-desc">Карты, СБП, криптовалюта и рассрочка</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Подписка на новости -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-wrapper">
                <div class="newsletter-content">
                    <div class="newsletter-icon">🎮</div>
                    <h2 class="newsletter-title">Будь в курсе игровых новинок</h2>
                    <p class="newsletter-desc">
                        Подпишись на рассылку и получай скидки, новости и эксклюзивные предложения
                    </p>
                    <form class="newsletter-form" action="#" method="POST">
                        @csrf
                        <div class="newsletter-input-group">
                            <input type="email" class="newsletter-input" placeholder="Введите email" required>
                            <button type="submit" class="newsletter-btn">
                                <i class="fas fa-paper-plane"></i> Подписаться
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection