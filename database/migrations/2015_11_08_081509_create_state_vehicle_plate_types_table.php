<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateVehiclePlateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('state_vehicle_plate_types')) {
            Schema::create('state_vehicle_plate_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('priority');
                $table->integer('state_vehicle_id')->unsigned();
                $table->integer('state_plate_type_id')->unsigned();
                $table->unique(['state_vehicle_id', 'state_plate_type_id'], 'unique_plate_and_vehicle_id');
                $table->foreign('state_vehicle_id')->references('id')->on('state_vehicle_types')->onDelete('cascade');
                $table->foreign('state_plate_type_id')->references('id')->on('state_plate_types')->onDelete('cascade');
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
        Schema::dropIfExists('state_vehicle_plate_types');
    }
}
