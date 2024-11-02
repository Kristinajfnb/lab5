<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTagTable extends Migration
{
    public function up()
    {
        Schema::create('task_tag', function (Blueprint $table) {
            $table->id(); // автоинкрементный первичный ключ
            $table->unsignedBigInteger('task_id'); // внешний ключ на таблицу tasks
            $table->unsignedBigInteger('tag_id'); // внешний ключ на таблицу tags

            // Установка внешних ключей
            $table->foreign('task_id')
                  ->references('id')
                  ->on('tasks')
                  ->onDelete('cascade'); // удаление связи при удалении задачи

            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('cascade'); // удаление связи при удалении тега
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_tag'); // удаление таблицы task_tag
    }
}
