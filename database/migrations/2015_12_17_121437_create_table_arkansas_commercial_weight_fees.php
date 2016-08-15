<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasCommercialWeightFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ar_commercial_weight_fees')) {
            Schema::create('ar_commercial_weight_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('weight_class_id')->unsigned();
                $table->integer('truck_class_id')->unsigned();
                $table->string('axle');
                $table->double('min_weight');
                $table->double('max_weight');
                $table->double('reg_fee');

                $table->date('start_date');
                $table->date('end_date');

                $table->foreign('truck_class_id')->references('id')->on('ar_truck_classes')->onDelete('cascade');
                $table->foreign('weight_class_id')->references('id')->on('ar_weight_fee_classes')->onDelete('cascade');

                // $table->foreign('reg_type_id')->references('id')->on('ar_registration_types')->onDelete('cascade');
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
        Schema::dropIfExists('ar_commercial_weight_fees');
    }
}
