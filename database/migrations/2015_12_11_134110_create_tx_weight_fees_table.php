<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTxWeightFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tx_weight_fees')) {
            Schema::create('tx_weight_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('weight_class');
                $table->double('min_weight');
                $table->double('max_weight');
                $table->double('reg_fee');
                $table->date('start_date');
                $table->date('end_date');
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
        Schema::dropIfExists('tx_weight_fees');
    }
}
