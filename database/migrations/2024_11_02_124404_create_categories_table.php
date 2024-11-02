<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Запустите миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // первичный ключ
            $table->string('name'); // название категории
            $table->text('description')->nullable(); // описание категории
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
        Schema::dropIfExists('categories');
    }
}
