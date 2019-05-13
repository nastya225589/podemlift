<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Admin\Models\Menu;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->smallInteger('published')->default(0);
            $table->integer('sort')->default(0);
            $table->string('name');
            $table->integer('page_id')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });

        Menu::create([
            'name' => 'Меню в футере',
            'published' => 1,
            'sort' => 1
        ]);
        Menu::create([
            'name' => 'Главная',
            'published' => 1,
            'parent_id' => 1,
            'page_id' => 1,
            'sort' => 1
        ]);
        Menu::create([
            'name' => 'Контакты',
            'published' => 1,
            'parent_id' => 1,
            'page_id' => 2,
            'sort' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
