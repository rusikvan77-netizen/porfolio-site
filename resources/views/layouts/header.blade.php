<!-- resources/views/layouts/header.blade.php -->
<header class="header">
    <div class="header-container">
        <!-- Логотип -->
        <div class="header-logo">
            <a href="{{ url('/FirstPage') }}" class="logo-link">
                <span class="logo-text">Player</span>
                <span class="logo-dot">.</span>
            </a>
        </div>

        <!-- Навигация (десктоп) -->
        <nav class="header-nav">
            <a href="{{ url('/FirstPage') }}"
                class="nav-link {{ request()->is('/') || request()->is('FirstPage') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Главная
            </a>
            <a href="{{ url('/faq') }}" class="nav-link {{ request()->is('secondPage') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i> Техсправка
            </a>
            <a href="{{ url('aboutUs') }}" class="nav-link">
                <i class="fas fa-users"></i> О нас
            </a>
            <a href="{{ url('/contacs') }}" class="nav-link">
                <i class="fas fa-envelope"></i> Контакты
            </a>
        </nav>

        <!-- Правая часть -->
        <div class="header-actions">
            @auth
                <div class="user-menu">
                    <button class="user-btn" onclick="toggleDropdown()">
                        <span class="user-avatar">
                            {{ auth()->user()->name ? substr(auth()->user()->name, 0, 1) : 'U' }}
                        </span>
                        <span class="user-name">{{ auth()->user()->name ?? 'Пользователь' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" id="userDropdown">
                        <a href="{{ url('/dashboard') }}" class="dropdown-item">
                            <i class="fas fa-tachometer-alt"></i> Личный кабинет
                        </a>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user-cog"></i> Настройки
                        </a>
                        <hr class="dropdown-divider">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Выйти
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">
                    <i class="fas fa-sign-in-alt"></i> Войти
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Регистрация
                    </a>
                @endif
            @endauth

            <!-- Мобильное меню (бургер) -->
            <button class="burger-menu" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Мобильная навигация -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-inner">
            <a href="{{ url('/FirstPage') }}"
                class="mobile-link {{ request()->is('/') || request()->is('FirstPage') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Главная
            </a>
            <a href="{{ url('/secondPage') }}" class="mobile-link {{ request()->is('secondPage') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i> Техсправка
            </a>
            <a href="#" class="mobile-link">
                <i class="fas fa-users"></i> О нас
            </a>
            <a href="#" class="mobile-link">
                <i class="fas fa-envelope"></i> Контакты
            </a>

            @guest
                <div class="mobile-auth">
                    <a href="{{ route('login') }}" class="mobile-btn btn-outline">Войти</a>
                    <a href="{{ route('register') }}" class="mobile-btn btn-primary">Регистрация</a>
                </div>
            @endguest
        </div>
    </div>
</header>
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function (event) {
        const userMenu = document.querySelector('.user-menu');
        if (!userMenu.contains(event.target)) {
            document.getElementById('userDropdown').classList.remove('show');
        }
    });

    function toggleMobileMenu() {
        const burger = document.querySelector('.burger-menu');
        const mobileMenu = document.getElementById('mobileMenu');

        burger.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    }

    document.querySelectorAll('.mobile-link').forEach(link => {
        link.addEventListener('click', () => {
            document.querySelector('.burger-menu').classList.remove('active');
            document.getElementById('mobileMenu').classList.remove('active');
        });
    });
</script>