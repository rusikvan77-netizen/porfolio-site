@extends('admin.index')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить игру</h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Введите название книги" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control" id="description"
                                        placeholder="Введите описание книги" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" step="0.01" name="price" class="form-control" id="price"
                                        placeholder="Введите цену" required>
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория товара</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">Выберите категорию</option>
                                        @foreach($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->nameCategory }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение поста</label>
                                    <input type="file" name="image" class="form-control" id="image" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection