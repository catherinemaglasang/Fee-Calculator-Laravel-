<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasPassengerWeightFees extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('ar_passenger_weight_fees')) {
            Schema::create('ar_passenger_weight_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('weight_class_id')->unsigned();
                $table->double('min_weight');
                $table->double('max_weight');
                $table->double('reg_fee');
                $table->date('start_date');
                $table->date('end_date');

                $table->foreign('weight_class_id')->references('id')->on('ar_weight_fee_classes')->onDelete('cascade');
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
        Schema::dropIfExists('ar_passenger_weight_fees');
    }
}
