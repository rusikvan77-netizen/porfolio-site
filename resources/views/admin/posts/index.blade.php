@extends('admin.index')

@section('content')
    <div class="container-fluid">
    <body>
        <h1 class="allPosts">Все посты</h1>
        <a class="createPost" href="{{ route('admin.posts.create') }}">Создать пост</a>
        <table>
            <thead>
                <tr>
                    <th>Айди</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Описание</th>
                    <th>Категория</th>
                    <th>Жанр</th>
                    <th>Картинка</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post['id'] }}</td>
                        <td>{{ $post['name'] }}</td>
                        <td>{{ $post['price'] }}</td>
                        <td>{{ $post['description'] }}</td>
                        <td>@if($post->category)
                            {{ $post->category->nameCategory }}
                        @else
                                <span class="noSetup">Категория не установлена</span>
                            @endif
                        </td>
                        <td>@if($post->genre)
                            {{ $post->genre->nameGenre }}
                        @else
                                <span class="noSetup">Жанр не установлен</span>
                            @endif
                        </td>
                        <td><img class="cardImg" src="{{ asset($post->img) }}" alt="logoCard"></td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.posts.edit', $post['id']) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Редактировать
                            </a>
                            <form action="{{ route('admin.posts.delete', $post['id']) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                    <i class="fas fa-trash"></i>
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
@endsection
</div>