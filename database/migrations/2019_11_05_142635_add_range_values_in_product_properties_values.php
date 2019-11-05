<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRangeValuesInProductPropertiesValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_properties_values', function (Blueprint $table) {
            $table->decimal('value_from', 8, 2)->nullable();
            $table->decimal('value_to', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_properties_values', function (Blueprint $table) {
            $table->dropColumn('value_from');
            $table->dropColumn('value_to');
        });
    }
}
