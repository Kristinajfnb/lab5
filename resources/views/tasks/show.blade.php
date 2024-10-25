@extends('layouts.app')

@section('title', 'Просмотр задачи')

@section('content')
    <h1>Задача: {{ $task['title'] }}</h1>
    <p><strong>ID:</strong> {{ $task['id'] }}</p>
    <p><strong>Описание:</strong> {{ $task['description'] ?? 'Нет описания.' }}</p>
    <p><strong>Статус:</strong> {{ $task['status'] ?? 'Не выполнена' }}</p>
    <p><strong>Приоритет:</strong> {{ $task['priority'] ?? 'Низкий' }}</p>
    <p><strong>Исполнитель:</strong> {{ $task['assignee'] ?? 'Не назначен' }}</p>
    <p><strong>Дата создания:</strong> {{ $task['created_at'] ?? 'Не указана' }}</p>
    <p><strong>Дата обновления:</strong> {{ $task['updated_at'] ?? 'Не указана' }}</p>

    <div class="mt-3">
        <a href="{{ route('tasks.edit', $task['id']) }}" class="btn btn-warning">Редактировать задачу</a>
        <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить задачу</button>
        </form>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Назад к списку задач</a>
    </div>
@endsection
