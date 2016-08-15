<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateVehicleTypeFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('state_vehicle_type_fees')) {
            Schema::create('state_vehicle_type_fees', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('state_vehicle_type_id')->unsigned();
                $table->integer('state_vehicle_fee_id')->unsigned();
                $table->double('amount');
                $table->date('start_date');
                $table->date('end_date');
                $table->unique(['state_vehicle_type_id', 'state_vehicle_fee_id', 'start_date', 'end_date'], 'date_and_type_unique');
                $table->foreign('state_vehicle_type_id')->references('id')->on('state_vehicle_types')->onDelete('cascade');
                $table->foreign('state_vehicle_fee_id')->references('id')->on('state_vehicle_fees')->onDelete('cascade');
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
        Schema::dropIfExists('state_vehicle_type_fees');
    }
}
