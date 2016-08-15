<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeCalculatorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('fee_calculator_logs')) {
            Schema::create('fee_calculator_logs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('state_code');
                $table->longText('log_params');
                $table->timestamp('date_added');
                $table->enum('status', ['SUCCESS', 'FAILURE']);
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
        Schema::dropIfExists('fee_calculator_logs');
    }
}
