<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // Генерация случайного заголовка задачи
            'description' => $this->faker->paragraph, // Генерация случайного описания
            'category_id' => Category::factory(), // Связывание с категорией
        ];
    }
}
