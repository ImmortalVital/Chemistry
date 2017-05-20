<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tank_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('tank_params', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('tank_values', function (Blueprint $table) {
            $table->increments('id');
            $table->float('min');
            $table->float('max');
        });

        Schema::create('tank_class_params', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->unsigned();
            $table->integer('param_id')->unsigned();
            $table->integer('value_id')->unsigned();

            $table->foreign('class_id')->references('id')->on('tank_classes');
            $table->foreign('param_id')->references('id')->on('tank_params');
            $table->foreign('value_id')->references('id')->on('tank_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_params');
        Schema::dropIfExists('values');
        Schema::dropIfExists('params');
        Schema::dropIfExists('classes');
    }
}
