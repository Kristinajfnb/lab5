<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class TaskController extends Controller
{
    // Метод для отображения списка задач
    public function index()
    {
        // Получаем все задачи из базы данных
    $tasks = Task::all();

    // Возвращаем представление и передаем список задач
    return view('tasks.index', compact('tasks'));
    }

    // Метод для отображения формы создания задачи
    public function create()
    {
        $categories = Category::all(); // Получение всех категорий для выпадающего списка
        $tags = Tag::all(); // Получение всех тегов для выпадающего списка
        return view('tasks.create', compact('categories', 'tags'));
    }

    // Метод для сохранения новой задачи
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id', // Проверка каждого тега
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
        ]);

        // Привязываем теги к задаче
        if (isset($validatedData['tags'])) {
            $task->tags()->attach($validatedData['tags']);
        }

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана!');
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
    public function edit($id)
    {
        $task = Task::with(['category', 'tags'])->findOrFail($id);
        $categories = Category::all(); // Получаем все категории для выбора
        $tags = Tag::all(); // Получаем все теги для выбора
        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    // Метод для обновления задачи
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->category_id = $request->input('category_id');
        $task->tags()->sync($request->input('tags', [])); // Обновляем теги
    
        $task->save();
    
        return redirect()->route('tasks.index')->with('success', 'Задача успешно обновлена!'); 
    }

    // Метод для удаления задачи
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена!');
    }
}
