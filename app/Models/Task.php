<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category_id']; // Добавьте поле для массового заполнения

    // Метод для связи с категорией
    public function category()
    {
        return $this->belongsTo(Category::class); // Одна задача принадлежит одной категории
    }

    // Метод для связи с тегами
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag'); // Задача может иметь много тегов
    }
}
