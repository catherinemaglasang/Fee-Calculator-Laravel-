<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNorthAmericanStates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pos_la_north_american_states')) {
            Schema::create('pos_la_north_american_states', function (Blueprint $table) {
                $table->increments('id');
                $table->string('state_code');
                $table->string('name');
                $table->string('slug');
                $table->string('country_code');
                $table->string('state_type_code');

                $table->index('state_code');
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
        Schema::dropIfExists('pos_la_north_american_states');
    }
}
