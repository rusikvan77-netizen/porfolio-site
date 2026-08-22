@extends('admin.index')
@section('content')
    <div class="container-fluid">

        <body>
            <h1 class="allPosts">Все Жанры</h1>
            <a class="createPost" href="{{ route('admin.genre.create') }}">Создать жанр</a>
            <table>
                <thead>
                    <tr>
                        <th>Айди</th>
                        <th>Название жанра</th>
                        <th>Описание</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genre as $genres)
                        <tr>
                            <td>{{ $genres['id'] }}</td>
                            <td>{{ $genres['nameGenre'] }}</td>
                            <td>{{ $genres['description'] }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.genre.edit', $genres['id']) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Редактировать
                                </a>
                                <form action="{{ route('admin.genre.delete', $genres['id']) }}" method="POST"
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