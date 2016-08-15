<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasPullingUnits extends Migration
{

    /**
     * AA
     * ST
     * PT
     * T
     */
    public function up()
    {
        if (!Schema::hasTable('ar_pulling_units')) {
            Schema::create('ar_pulling_units', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
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
        Schema::dropIfExists('ar_pulling_units');
    }
}
