@extends('layouts.app')

@section('content')
    <div class="dashboard-page">
        <!-- Hero-секция -->
        <section class="dashboard-hero">
            <div class="dashboard-container">
                <h1 class="dashboard-title">👋 Личный <span class="dashboard-highlight">кабинет</span></h1>
                <p class="dashboard-subtitle">Добро пожаловать, {{ $user->name }}!</p>
            </div>
        </section>

        <div class="dashboard-container">
            <div class="dashboard-grid">
                <!-- Левая колонка - Информация о пользователе -->
                <div class="dashboard-main">
                    <!-- Профиль -->
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="profile-info">
                                <h2 class="profile-name">{{ $user->name }}</h2>
                                <span class="profile-email">{{ $user->email }}</span>
                                <span class="profile-status">
                                    <span class="status-dot"></span>
                                    Активен
                                </span>
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-stats">
                                <div class="stat-item">
                                    <span class="stat-value">{{ $ordersCount ?? 0 }}</span>
                                    <span class="stat-label">Заказов</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $reviewsCount ?? 0 }}</span>
                                    <span class="stat-label">Отзывов</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">⭐ {{ $averageRating ?? 0 }}</span>
                                    <span class="stat-label">Рейтинг</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Мои заказы -->
                    <div class="orders-section">
                        <h2>📦 Мои заказы</h2>
                        @if(isset($orders) && $orders->count() > 0)
                            <div class="orders-list">
                                @foreach($orders as $order)
                                    <div class="order-item">
                                        <div class="order-info">
                                            <span class="order-id">Заказ #{{ $order->id }}</span>
                                            <span class="order-date">{{ $order->created_at->format('d.m.Y') }}</span>
                                        </div>
                                        <div class="order-status">
                                            <span class="status-badge status-{{ $order->status }}">
                                                {{ $order->status_text ?? 'Обрабатывается' }}
                                            </span>
                                        </div>
                                        <div class="order-total">
                                            {{ number_format($order->total, 0, '', ' ') }} ₽
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">🛒</div>
                                <h3>У вас пока нет заказов</h3>
                                <p>Перейдите в каталог и выберите свою первую игру</p>
                                <a href="{{ route('FirstPage') }}" class="empty-btn">В каталог</a>
                            </div>
                        @endif
                    </div>

                    <!-- Мои отзывы -->
                    <div class="reviews-section">
                        <h2>💬 Мои отзывы</h2>
                        @if(isset($userReviews) && $userReviews->count() > 0)
                            <div class="reviews-list">
                                @foreach($userReviews as $review)
                                    <div class="review-item">
                                        <div class="review-header">
                                            <span class="review-game">{{ $review->post->name ?? 'Игра удалена' }}</span>
                                            <span class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        ⭐
                                                    @else
                                                        ☆
                                                    @endif
                                                @endfor
                                            </span>
                                        </div>
                                        <p class="review-text">{{ Str::limit($review->comment, 100) }}</p>
                                        <span class="review-date">{{ $review->created_at->format('d.m.Y') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state small">
                                <div class="empty-icon">✍️</div>
                                <p>Вы ещё не оставляли отзывов</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Правая колонка -->
                <div class="dashboard-sidebar">
                    <!-- Настройки -->
                    <div class="settings-card">
                        <h3>⚙️ Настройки</h3>
                        <div class="settings-list">
                            <a href="{{ route('profile.edit') }}" class="settings-item">
                                <i class="fas fa-user-edit"></i>
                                <span>Редактировать профиль</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="settings-item">
                                <i class="fas fa-key"></i>
                                <span>Сменить пароль</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="#" class="settings-item">
                                <i class="fas fa-bell"></i>
                                <span>Уведомления</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            @if(auth()->user()->admin())
                                <a href="{{ route('admin.index') }}" class="settings-item admin">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Админ-панель</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Быстрые действия -->
                    <div class="quick-actions">
                        <h3>🚀 Быстрые действия</h3>
                        <a href="{{ route('FirstPage') }}" class="quick-btn">
                            <i class="fas fa-store"></i>
                            <span>В магазин</span>
                        </a>
                        <a href="{{ route('FirstPage') }}" class="quick-btn">
                            <i class="fas fa-gamepad"></i>
                            <span>Популярные игры</span>
                        </a>

                    </div>

                    <!-- Выход -->
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Выйти из аккаунта
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection