<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateVehicleTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('state_vehicle_types')) {
            Schema::create('state_vehicle_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('vehicle_type_id')->unsigned();
                $table->string('state_code');
                $table->integer('priority');

                $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
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
        Schema::dropIfExists('state_vehicle_types');
    }
}
