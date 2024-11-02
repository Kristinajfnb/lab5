<!DOCTYPE html>
<html>
<head>
    <title>{{ $task->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Подключение CSS -->
</head>
<body>
    <div class="container">
        <h1>{{ $task->title }}</h1>
        <p><strong>Описание:</strong> {{ $task->description }}</p>
        <p><strong>Категория:</strong> {{ $task->category->name ?? 'Нет категории' }}</p>
        <p><strong>Теги:</strong>
            @if($task->tags->isEmpty())
                Нет тегов
            @else
                <ul>
                    @foreach($task->tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>
            @endif
        </p>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Назад к списку задач</a>
    </div>
</body>
</html>
