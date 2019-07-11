<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Admin\Models\Page;

class AddInMenuToProductCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->boolean('in_menu')->default(false);
            $table->string('name_in_menu')->nullable();
        });

        $catalogPage = Page::where('slug', 'catalog')->first() ??
            new Page([
                'name' => 'Каталог',
                'slug' => 'catalog',
                'in_menu' => true
            ]);

        $catalogPage->behavior = 'catalog';
        $catalogPage->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn(['in_menu', 'name_in_menu']);
        });
    }
}
