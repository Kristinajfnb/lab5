<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

// ...

// Маршрут для главной страницы
Route::get('/', [HomeController::class, 'index']);

// Страница "О нас"
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Ресурсный контроллер для задач

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

Route::resource('tasks', TaskController::class);