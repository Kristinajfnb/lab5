# Лабораторная работа №3. Основы создания и управления форм в Laravel

## Цель работы

Познакомиться с основами создания и управления формами в Laravel. Освоить механизмы валидации данных на сервере, использовать предустановленные и кастомные правила валидации, а также научиться обрабатывать ошибки и обеспечивать безопасность данных.

### Задания

1. Создаю форму для добавления новой задачи. Форма должна содержать следующие поля: Название, Описание, Дата выполнения, Категория.

2. Создаем маршрут POST /tasks для сохранения данных из формы в базе данных. Для удобства  использую ресурсный контроллер.
```php
use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class);
```
3. Обновляем контроллер TaskController.
```php
public function create()
{
    $categories = \App\Models\Category::all(); // Получаем все категории для выпадающего списка
    return view('tasks.create', compact('categories'));
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'category_id' => 'required|exists:categories,id'
    ]);

    Task::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'due_date' => $request->input('due_date'),
        'category_id' => $request->input('category_id')
    ]);

    return redirect()->route('tasks.index')->with('success', 'Задача успешно добавлена.');
}
```
![Ку](images/1.png)

4. Реализуем валидацию данных непосредственно в методе store контроллера TaskController.
```php
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'title' => 'required|string|min:3',
            'description' => 'nullable|string|max:500',
            'due_date' => 'required|date|after_or_equal:today', // Дата не может быть в прошлом
            'category_id' => 'required|exists:categories,id', // Должна быть валидная категория
        ]);

        // Если валидация прошла успешно, создаем задачу
        Task::create($validated);

        // Перенаправляем на страницу задач с сообщением об успешном создании
        return redirect()->route('tasks.index')->with('success', 'Задача успешно добавлена!');
    }
```
5. Обрабатываем ошибки валидации и возвращаем их обратно к форме, отображая сообщения об ошибках рядом с полями.

```php
      <div>{{ $message }}</div>
```
![Ку](images/2.png)

6. Создаем собственный класс запроса для валидации формы задачи.
- `php artisan make:request CreateTaskRequest`
7. В классе CreateTaskRequest определяем правила валидации, аналогичные тем, что были в контроллере.

```php
 public function rules()
    {
        return [
            'title' => 'required|string|min:3',
            'description' => 'nullable|string|max:500',
            'due_date' => 'required|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id',
        ];
    }
```
8. Обновляем метод store контроллера TaskController для использования CreateTaskRequest вместо стандартного Request.

```php
 public function store(CreateTaskRequest $request)
    {
        // Данные уже прошли валидацию, можем сохранить задачу
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'category_id' => $request->input('category_id'),
        ]);

        // Перенаправляем с сообщением об успешном создании
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }
```
9. Добавляем логику валидации для связанных данных.

```php
  public function rules()
    {
        return [
            'title' => 'required|string|min:3',
            'description' => 'nullable|string|max:500',
            'due_date' => 'required|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id', // Проверка, что category_id существует в таблице categories
        ];
    }
```
10. Обновляем HTML-форму для отображения подтверждающего сообщения об успешном сохранении задачи (флеш-сообщение).

```php
  // Добавляем флеш-сообщение об успешном сохранении
    return redirect()->route('tasks.index')->with('success', 'Задача успешно создана.');
```
```php
{{-- Проверка наличия флеш-сообщений --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
```
![Ку](images/3.png)

11. Добавляем директиву @csrf в форму для защиты от атаки CSRF.
```php
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Название</label>
        <input type="text" name="title" id="title" required>
    </div>

    <div>
        <label for="description">Описание</label>
        <textarea name="description" id="description"></textarea>
    </div>
```
12. Добавляем возможность редактирования задачи. Создаем форму для редактирования задачи.

![Ку](images/4.png)

13. Создаем новый Request-класс UpdateTaskRequest с аналогичными правилами валидации.

- `php artisan make:request UpdateTaskRequest`

14. Создаем маршрут GET /tasks/{task}/edit и метод edit в контроллере TaskController.

```php
use App\Http\Controllers\TaskController;

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
```

15. Создаем маршрут PUT /tasks/{task} для обновления задачи.

```php
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
```

16. Обновляем метод update в контроллере TaskController для обработки данных из формы.

```php
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
```

## Контрольные вопросы
1. Что такое валидация данных и зачем она нужна? Валидация данных — это процесс проверки и подтверждения того, что данные, введенные пользователем в форму, соответствуют определенным правилам. Зачем она нужна: предотвращение ошибок, безопасность, удобство пользователя.
2. Как обеспечить защиту формы от CSRF-атак в Laravel? CSRF (Cross-Site Request Forgery) — это тип атаки, при которой злоумышленник заставляет пользователя выполнить нежелательные действия на веб-сайте, на котором он аутентифицирован. Laravel защищает от CSRF-атак с помощью специального токена, который необходимо включить в каждую форму, отправляющую данные методом POST, PUT, DELETE.
3. Как создать и использовать собственные классы запросов (Request) в Laravel? Классы запросов в Laravel — это специальные классы, которые используются для инкапсуляции логики валидации и авторизации. Это помогает разделить логику контроллера и улучшить читаемость и поддержку кода.
- `php artisan make:request UpdateTaskRequest`
4. Как защитить данные от XSS-атак при выводе в представлении? Защита от XSS-атак обеспечивается через автоматическое экранирование данных, выводимых в Blade-шаблонах с помощью {{ }}.