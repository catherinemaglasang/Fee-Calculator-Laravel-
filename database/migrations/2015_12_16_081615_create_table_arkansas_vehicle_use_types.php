<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasVehicleUseTypes extends Migration
{

    /**
     *  PERSONAL
        PERSONAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL
        COMMERCIAL | PERSONAL
        COMMERCIAL | PERSONAL
     */
    public function up()
    {
        if (!Schema::hasTable('ar_vehicle_use_types')) {
            Schema::create('ar_vehicle_use_types', function (Blueprint $table) {
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
        Schema::dropIfExists('ar_vehicle_use_types');
    }
}
