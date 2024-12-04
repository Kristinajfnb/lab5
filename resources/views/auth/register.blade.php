@extends('layouts.app')

@section('content')
<h1>Регистрация</h1>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label>Имя:</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label>Пароль:</label>
        <input type="password" name="password">
        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label>Повторите пароль:</label>
        <input type="password" name="password_confirmation">
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>
@endsection
