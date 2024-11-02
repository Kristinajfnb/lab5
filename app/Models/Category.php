<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description']; // поля для массового заполнения
     // Метод для связи с задачами
     public function tasks()
     {
         return $this->hasMany(Task::class); // Одна категория имеет много задач
     }
}
