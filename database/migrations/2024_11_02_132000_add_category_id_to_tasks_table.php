<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('id'); // добавление поля category_id
            
            // Установка внешнего ключа
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade'); // удаление задачи при удалении категории
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // удаление внешнего ключа
            $table->dropColumn('category_id'); // удаление поля category_id
        });
    }
}
