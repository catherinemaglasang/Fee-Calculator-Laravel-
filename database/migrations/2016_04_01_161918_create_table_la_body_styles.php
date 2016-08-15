<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLaBodyStyles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('la_body_styles')) {
            Schema::create('la_body_styles', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('vehicle_id')->unsigned();
                $table->string('slug')->unique();
                $table->string('body_style');
                $table->string('code');
                $table->integer('priority');
                $table->date('start_date');
                $table->date('end_date');

                $table->foreign('vehicle_id')->references('id')->on('vehicle_types')->onDelete('cascade');
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
        Schema::dropIfExists('la_body_styles');
    }
}
