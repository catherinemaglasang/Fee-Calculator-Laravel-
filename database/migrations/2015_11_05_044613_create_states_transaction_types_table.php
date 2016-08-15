<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('states_transaction_types')) {
            Schema::create('states_transaction_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('priority');
                $table->string('state_code');
                $table->string('transaction_type_code');
                $table->foreign('transaction_type_code')->references('code')->on('transaction_types')->onDelete('cascade');
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
        Schema::dropIfExists('states_transaction_types');
    }
}
