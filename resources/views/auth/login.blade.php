@extends('layouts.app')

@section('content')
<h1>Вход</h1>
<form action="{{ route('login') }}" method="POST">
    @csrf
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
    <button type="submit">Войти</button>
</form>
@endsection
