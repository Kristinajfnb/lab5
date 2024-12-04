<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// ...

// Маршрут для главной страницы
Route::get('/', [HomeController::class, 'index']);

// Страница "О нас"
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Ресурсный контроллер для задач

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

Route::resource('tasks', TaskController::class);

// Регистрация
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);

// Вход
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin']);

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// В routes/web.php
Route::get('/home', [HomeController::class, 'index'])->name('home');
//cabinet
Route::middleware(['auth'])->get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Для администраторов
    Route::middleware('admin')->get('/admin/users', [AdminController::class, 'index'])->name('admin.users');});