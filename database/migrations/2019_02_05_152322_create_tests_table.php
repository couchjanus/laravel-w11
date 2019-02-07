<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            // Инкрементный ID (первичный ключ), использующий эквивалент "UNSIGNED INTEGER"
            $table->increments('id');
            // Эквивалент VARCHAR с длинной
            $table->string('name', 100);
            //Эквивалент TEXT для базы данных
            $table->text('description');    
            // Добавление столбцов created_at и updated_at (разрешено значение NULL)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
