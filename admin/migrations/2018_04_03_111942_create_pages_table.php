<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Page;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('behavior')->nullable();
            $table->smallInteger('published');
            $table->integer('sort')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->string('url')->default('');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('fields');
            $table->text('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Page::create([
            'name' => 'Главная',
            'slug' => '/',
            'url' => '/',
            'sort' => 1,
            'published' => 1,
            'behavior' => 'main'
        ]);
        Page::create([
            'name' => 'Контакты',
            'slug' => 'contacts',
            'url' => '/contacts',
            'sort' => 2,
            'published' => 1,
            'behavior' => 'contacts'
        ]);
        Page::create([
            'name' => 'Demo fields',
            'slug' => 'demo',
            'url' => '/demo',
            'sort' => 3,
            'published' => 1,
            'behavior' => 'demo'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
