<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaLicenseWeightFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('la_license_weight_fees')) {
            Schema::create('la_license_weight_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('state_vehicle_type_id')->unsigned();
                $table->double('begin_weight');
                $table->double('end_weight');
                $table->double('fee');
                $table->boolean('is_rate')->default(false);
                $table->double('per_pound_rate')->default(0);
                $table->boolean('is_farm')->default(false);
                $table->boolean('prorated')->default(false);
                $table->date('start_date');
                $table->date('end_date');
                $table->enum('proration_month', ['July']);
                $table->foreign('state_vehicle_type_id')->references('id')->on('state_vehicle_types')->onDelete('cascade');
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
        Schema::dropIfExists('la_license_weight_fees');
    }
}
