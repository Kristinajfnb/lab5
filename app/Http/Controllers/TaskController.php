<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Метод для отображения списка задач
    public function index()
    {
        // Статические данные для задач
        $tasks = [
            ['id' => 1, 'title' => 'Задача 1'],
            ['id' => 2, 'title' => 'Задача 2'],
            ['id' => 3, 'title' => 'Задача 3'],
        ];

        return view('tasks.index', ['tasks' => $tasks]); // Возвращаем представление с задачами
    }

    // Метод для отображения формы создания задачи
    public function create()
    {
        // Временный вывод, пока не реализована форма
        return 'Форма создания задачи'; 
    }

    // Метод для сохранения новой задачи
    public function store(Request $request)
    {
        // Временный вывод, пока не реализовано сохранение
        return 'Задача сохранена'; 
    }

    // Метод для отображения отдельной задачи
    public function show($id)
    {
        $task = [
            'id' => $id,
            'title' => 'Task Title ' . $id,
            // Здесь могут быть дополнительные данные задачи
        ];

        return view('tasks.show', ['task' => $task]); // Возвращаем представление с конкретной задачей
    }

    // Метод для отображения формы редактирования задачи
    public function edit($id)
    {
        // Временный вывод, пока не реализована форма редактирования
        return 'Форма редактирования задачи с ID: ' . $id; 
    }

    // Метод для обновления задачи
    public function update(Request $request, $id)
    {
        // Временный вывод, пока не реализовано обновление
        return 'Задача с ID ' . $id . ' обновлена'; 
    }

    // Метод для удаления задачи
    public function destroy($id)
    {
        // Временный вывод, пока не реализовано удаление
        return 'Задача с ID ' . $id . ' удалена'; 
    }
}
