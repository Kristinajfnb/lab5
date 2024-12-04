@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="text-center">
        <h1>Добро пожаловать в To-Do App!</h1>
        <p>To-Do App для команд.</p>
        <p>
            <a class="btn btn-primary" href="{{ route('tasks.index') }}">Список задач</a>
            <a class="btn btn-secondary" href="{{ route('tasks.create') }}">Создать задачу</a>
            <a href="{{ route('login') }}">Вход</a>
            <a href="{{ route('register') }}">Регистрация</a>
        </p>
    </div>

    <h2>Информация о приложении</h2>
    <p>
        Это приложение позволяет командам эффективно управлять задачами, делиться списками дел и отслеживать прогресс. 
        Основные функции включают в себя создание, редактирование и удаление задач, а также возможность просмотра всех задач в одном месте.
    </p>
@endsection
