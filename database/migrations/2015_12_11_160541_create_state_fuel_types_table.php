<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateFuelTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('state_fuel_types')) {
            Schema::create('state_fuel_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('fuel_type_id')->unsigned();
                $table->string('state_code');

                // Foreign.
                $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onDelete('cascade');
                $table->foreign('state_code')->references('code')->on('states')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_fuel_types');
    }
}
