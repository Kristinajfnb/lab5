@extends('layouts.app')

@section('title', 'Список задач')

@section('content')
    <h1>Список задач</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task['id'] }}</td>
                    <td>{{ $task['title'] }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task['id']) }}" class="btn btn-info">Просмотреть</a>
                        <a href="{{ route('tasks.edit', $task['id']) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
