<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Добавьте поле для массового заполнения

    // Метод для связи с задачами
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_tag'); // Тег может быть прикреплен к многим задачам
    }
}
