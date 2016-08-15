<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateVehicleFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('state_vehicle_fees')) {
            Schema::create('state_vehicle_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('fee_id')->unsigned();
                $table->string('state_code');
                $table->integer('priority');
                $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
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
        Schema::dropIfExists('state_vehicle_fees');
    }
}
