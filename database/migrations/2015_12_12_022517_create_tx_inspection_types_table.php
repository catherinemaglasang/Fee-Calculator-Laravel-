<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTxInspectionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tx_inspection_fees')) {
            Schema::create('tx_inspection_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code')->unique()->unique();
                $table->string('name');
                $table->double('state_inspection_fee');
                $table->double('dealer_inspection_fee');
                $table->integer('priority')->unique();
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
        Schema::dropIfExists('tx_inspection_fees');
    }
}
