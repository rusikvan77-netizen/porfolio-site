<header class="HEAD">
    @if (Route::has('login'))
        <div class="div">
            <div class="divImg"><a href="{{ url('/FirstPage') }}">Player.</a></div>
            <a class="HEADelements" href="{{ route('admin.posts.index') }}">Посты</a>
            <a class="HEADelements" href="{{ route('admin.category.index') }}">Категории</a>
            <a class="HEADelements" href="{{ route('admin.reviews.index') }}">Отзывы</a>
            <a class="HEADelements" href="{{ route('admin.genre.index') }}">Жанры</a>

            <nav class="HEADParent">
                @auth
                    <a class="HEADelementsButton" href="{{ url('/') }}">
                        На Главную страницу
                    </a>
                @endauth
            </nav>
        </div>
    @endif
</header>
@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif