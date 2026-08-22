@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать пост об игре</h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Название -->
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Введите название книги" 
                                        value="{{ old('name', $post->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Описание -->
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control" id="description"
                                        placeholder="Введите описание книги" 
                                        required>{{ old('description', $post->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Цена -->
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" step="0.01" name="price" class="form-control" id="price"
                                        placeholder="Введите цену" 
                                        value="{{ old('price', $post->price) }}" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Категория -->
                                <div class="form-group">
                                    <label for="category_id">Категория товара</label>
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="">Выберите категорию</option>
                                        @foreach($category as $categories)
                                            <option value="{{ $categories->id }}" 
                                                {{ old('category_id', $post->category_id) == $categories->id ? 'selected' : '' }}>
                                                {{ $categories->nameCategory }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Жанр -->
                                <div class="form-group">
                                    <label for="genre_id">Жанр товара</label>
                                    <select name="genre_id" class="form-control" id="genre_id" required>
                                        <option value="">Выберите жанр</option>
                                        @foreach($genre as $genres)
                                            <option value="{{ $genres->id }}" 
                                                {{ old('genre_id', $post->genre_id) == $genres->id ? 'selected' : '' }}>
                                                {{ $genres->nameGenre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('genre_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение поста</label>
                                    @if($post->img)
                                        <div class="mb-2">
                                            <img src="{{ asset($post->img) }}" alt="Текущее изображение" style="max-height: 150px;">
                                            <p class="text-muted">Текущее изображение</p>
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control" id="image">
                                    <small class="text-muted">Оставьте пустым, если не хотите менять изображение</small>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection