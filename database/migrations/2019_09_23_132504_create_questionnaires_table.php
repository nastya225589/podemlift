<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('organization');
            $table->string('phone');
            $table->string('email');
            $table->string('mailing_address')->nullable();
            $table->date('delivery_at')->nullable();
            $table->string('delivery')->nullable();
            $table->integer('carrying')->nullable();
            $table->integer('lift')->nullable();
            $table->string('type_of_lift')->nullable();
            $table->string('place')->nullable();
            $table->string('number_of_stops')->nullable();
            $table->string('load_method')->nullable();
            $table->string('type_of_platform')->nullable();
            $table->boolean('tailgate')->nullable();
            $table->boolean('swing_doors')->nullable();
            $table->boolean('signaling')->nullable();
            $table->text('additionally')->nullable();
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
        Schema::dropIfExists('questionnaires');
    }
}
