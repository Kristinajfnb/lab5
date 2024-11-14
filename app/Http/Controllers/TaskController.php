<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    // Метод для отображения списка задач
    public function index()
    {
        $tasks = Task::all(); // Получаем все задачи
        return view('tasks.index', compact('tasks')); // Передаем задачи в представление
    }

    // Метод для отображения формы создания задачи
    public function create()
    {
        $categories = Category::all(); // Получаем все категории для выпадающего списка
        return view('tasks.create', compact('categories')); // Отправляем категории в представление
    }

    // Метод для сохранения новой задачи
    public function store(CreateTaskRequest $request)
    {
        // Данные уже прошли валидацию, можем сохранить задачу
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'category_id' => $request->input('category_id'),
        ]);

       // Добавляем флеш-сообщение об успешном сохранении
    return redirect()->route('tasks.index')->with('success', 'Задача успешно создана.');
    }

    // Метод для отображения отдельной задачи
    public function show($id)
    {
       // Получаем задачу по идентификатору с её категорией и тегами
    $task = Task::with(['category', 'tags'])->findOrFail($id);

    // Возвращаем представление и передаем информацию о задаче
    return view('tasks.show', compact('task'));
    }

    // Метод для отображения формы редактирования задачи
    public function edit(Task $task)
{
    $categories = Category::all(); // Получение всех категорий
    return view('tasks.edit', compact('task', 'categories')); // Возвращаем представление с данными
}

    // Метод для обновления задачи
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Данные уже прошли валидацию через UpdateTaskRequest
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'category_id' => $request->input('category_id'),
        ]);
    
        // Добавляем флеш-сообщение об успешном обновлении
        return redirect()->route('tasks.index')->with('success', 'Задача успешно обновлена.');
    }
    // Метод для удаления задачи
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена!');
    }
}
