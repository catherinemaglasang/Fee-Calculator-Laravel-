<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesOptionsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('states_options')) {
            Schema::create('states_options', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('option_id')->unsigned();
                $table->integer('priority');
                $table->string('state_code');
                $table->foreign('state_code')->references('code')->on('states')->onDelete('cascade');
                $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
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
        Schema::dropIfExists('states_options');
    }
}
