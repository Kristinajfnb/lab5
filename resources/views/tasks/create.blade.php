<!DOCTYPE html>
<html>
<head>
    <title>Создание задачи</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Подключение CSS -->
</head>
<body>
    <div class="container">
        <h1>Создание задачи</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Название задачи</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Описание задачи</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Категория</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Теги</label>
                @foreach($tags as $tag)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="tags[]" value="{{ $tag->id }}">
                        <label class="form-check-label">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Создать задачу</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
</body>
</html>
