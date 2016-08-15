<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosLaStatePlateCodeCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pos_la_state_plate_code_categories')) {
            Schema::create('pos_la_state_plate_code_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->unique();
                $table->string('name')->unique();
                $table->index('slug');
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
        Schema::dropIfExists('pos_la_state_plate_code_categories');
    }
}
