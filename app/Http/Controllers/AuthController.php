<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // 1. Показать форму регистрации
    public function register()
    {
        return view('auth.register');
    }

    // 2. Обработать данные формы регистрации
    public function storeRegister(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|min:3|max:50',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);
     // Вход пользователя
     Auth::login($user);
    // Присваиваем роль администратор или пользователь
$user->roles()->attach(Role::where('name', 'user')->first());

    // Перенаправление после регистрации
    return redirect()->route('profile');
}

    // 3. Показать форму входа
    public function login()
    {
        return view('auth.login');
    }

    // 4. Обработать данные формы входа
    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Вы успешно вошли в систему.');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ])->onlyInput('email');
    }

    // 5. Выход из системы
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Вы успешно вышли из системы.');
    }
}
