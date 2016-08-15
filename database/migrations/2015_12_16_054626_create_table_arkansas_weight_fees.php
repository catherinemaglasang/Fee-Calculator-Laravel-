<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasWeightFees extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('ar_weight_fee_classes')) {
            Schema::create('ar_weight_fee_classes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('weight_class')->unsigned();
                $table->integer('min_gvwr');
                $table->integer('max_gvwr');
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
        Schema::dropIfExists('ar_weight_fee_classes');
    }
}
