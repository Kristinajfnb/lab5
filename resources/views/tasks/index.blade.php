<!DOCTYPE html>
<html>
<head>
    <title>Список задач</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Подключение CSS -->
</head>
<body>
    <div class="container">
        <h1>Список задач</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Название задачи</th>
                    <th>Категория</th>
                    <th>Теги</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->category->name ?? 'Нет категории' }}</td>
                        <td>
                            @if($task->tags->isEmpty())
                                Нет тегов
                            @else
                                <ul>
                                    @foreach($task->tags as $tag)
                                        <li>{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Просмотреть</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
