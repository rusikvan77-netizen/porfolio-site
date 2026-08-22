@extends('admin.index')
@section('content')

    <body>
        <h1 class="allPosts">Все категории</h1>
        <a class="createPost" href="{{ route('admin.category.create') }}">Создать категорию</a>
        <table>
            <thead>
                <tr>
                    <th>Айди</th>
                    <th>Название категории</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category['id'] }}</td>
                        <td>{{ $category['nameCategory'] }}</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.category.edit', $category['id']) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Редактировать
                            </a>
                            <form action="{{ route('admin.category.delete', $category['id']) }}" method="POST"
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