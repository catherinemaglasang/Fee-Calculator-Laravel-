<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosLaTransactionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pos_la_transaction_types')) {
            Schema::create('pos_la_transaction_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();;
                $table->string('code')->unique();
                $table->integer('priority');
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
        Schema::dropIfExists('pos_la_transaction_types');
    }
}
