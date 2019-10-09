<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMetaDescriptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('stories', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('application_spheres', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('works', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('seo_data', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->text('meta_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('stories', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('application_spheres', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('works', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('seo_data', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('meta_description')->nullable()->change();
        });
    }
}
