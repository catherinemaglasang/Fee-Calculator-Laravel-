<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosLaStatePlateCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pos_la_state_plate_codes')) {
            Schema::create('pos_la_state_plate_codes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('vehicle_id')->unsigned();
                $table->string('begin_license');
                $table->string('end_license');
                $table->string('plate_prefix');
                $table->string('class_code');
                $table->integer('plate_type_id')->unsigned();
                $table->double('start_weight_range');
                $table->double('end_weight_range');
                $table->string('prefix');
                $table->string('spcd');
                $table->string('rgpr');
                $table->string('fee_code');
                $table->integer('number_of_years');
                $table->boolean('spov');
                $table->double('init_fee');
                $table->double('weight_per_hundred');
                $table->double('weight_per_thousand');
                $table->boolean('prorated');
                $table->boolean('staggered');
                $table->double('fixed');
                $table->double('per_passenger');
                $table->integer('vehicle_priority');

                $table->foreign('vehicle_id')->references('id')->on('vehicle_types')->onDelete('cascade');
                $table->foreign('plate_type_id')->references('id')->on('pos_la_state_plate_code_categories')->onDelete('cascade');
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
        Schema::dropIfExists('pos_la_state_plate_codes');
    }
}
