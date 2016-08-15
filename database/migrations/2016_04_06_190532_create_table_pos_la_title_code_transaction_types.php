<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosLaTitleCodeTransactionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pos_la_title_code_transaction_types')) {
            Schema::create('pos_la_title_code_transaction_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('pos_title_code_id')->unsigned();
                $table->integer('pos_transaction_type_id')->unsigned();
                $table->boolean('selected')->default(false);

                $table->foreign('pos_title_code_id', 'foreign_title_code_id')->references('id')->on('pos_la_title_codes');
                $table->foreign('pos_transaction_type_id', 'foreign_transaction_type_id_2')->references('id')->on('pos_la_transaction_types');
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
        Schema::dropIfExists('pos_la_title_code_transaction_types');
    }
}
