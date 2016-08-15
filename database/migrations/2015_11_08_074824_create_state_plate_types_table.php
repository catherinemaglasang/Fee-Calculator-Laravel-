<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatePlateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('state_plate_types')) {
            Schema::create('state_plate_types', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('plate_type_id')->unsigned();
                $table->string('state_code');
                $table->unique(['plate_type_id', 'state_code']);
                $table->foreign('plate_type_id')->references('id')->on('plate_types')->onDelete('cascade');
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
        Schema::dropIfExists('state_plate_types');
    }
}
