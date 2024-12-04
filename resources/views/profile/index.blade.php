@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Личный кабинет</h1>
        
        {{-- Если пользователь администратор, выводим все профили --}}
        @can('view-any-profile')
            <h2>Все профили:</h2>
            @foreach($profiles as $profile)
                <div>
                    <p>Имя: {{ $profile->name }}</p>
                    <p>Email: {{ $profile->email }}</p>
                    <hr>
                </div>
            @endforeach
        @else
            {{-- Для обычного пользователя показываем только его профиль --}}
            <p>Добро пожаловать, {{ $user->name }}!</p>
            <p>Email: {{ $user->email }}</p>
        @endcan
        
        {{-- Кнопка для выхода --}}
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выйти
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
