<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Определить, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        // Устанавливаем на true, если разрешаем всем пользователям создавать задачи
        return true;
    }

    /**
     * Получить правила валидации, которые должны применяться к запросу.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:3',
            'description' => 'nullable|string|max:500',
            'due_date' => 'required|date|after_or_equal:today',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Получить сообщения валидации по умолчанию.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Название задачи обязательно.',
            'title.min' => 'Название должно быть минимум 3 символа.',
            'description.max' => 'Описание не может превышать 500 символов.',
            'due_date.required' => 'Дата выполнения задачи обязательна.',
            'due_date.date' => 'Введите корректную дату.',
            'due_date.after_or_equal' => 'Дата выполнения должна быть не меньше сегодняшней.',
            'category_id.required' => 'Выберите категорию для задачи.',
            'category_id.exists' => 'Выбранная категория не существует.',
        ];
    }
}
