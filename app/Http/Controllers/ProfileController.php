<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function index()
    {
        // Получаем текущего авторизованного пользователя
        $user = auth()->user();

        // Проверяем, может ли текущий пользователь просматривать все профили
        if (Gate::allows('view-any-profile')) {
            // Администратор может просматривать все профили
            $profiles = Profile::all();  // Получаем все профили из базы данных
            return view('profile.index', compact('profiles'));  // Отправляем все профили в представление
        }

        // Если это не администратор, показываем только свой профиль
        return view('profile.index', compact('user'));  // Отправляем только текущий профиль пользователя
    }
    public function showProfile()
{
    $user = auth()->user(); // Получаем текущего аутентифицированного пользователя
    return view('profile.index', compact('user')); // Передаем переменную в представление
}
}
