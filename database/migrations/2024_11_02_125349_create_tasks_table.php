<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Запустите миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // первичный ключ
            $table->string('title'); // название задачи
            $table->text('description')->nullable(); // описание задачи
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Откатите миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
