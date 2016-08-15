<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasTrailerFees extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ar_trailer_fees')) {
            Schema::create('ar_trailer_fees', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('tag_prefix_id')->unsigned();
                $table->integer('pulling_units_id')->unsigned();
                $table->integer('min_gvwr');
                $table->integer('max_gvwr');
                $table->integer('vehicle_use_type_id')->unsigned();
                $table->integer('reg_type_id')->unsigned();
                $table->double('reg_fee');
                $table->date('start_date');
                $table->date('end_date');

                $table->foreign('tag_prefix_id')->references('id')->on('ar_tax_rates')->onDelete('cascade');
                $table->foreign('pulling_units_id')->references('id')->on('ar_pulling_units')->onDelete('cascade');
                $table->foreign('vehicle_use_type_id')->references('id')->on('ar_vehicle_use_types')->onDelete('cascade');
                $table->foreign('reg_type_id')->references('id')->on('ar_registration_types')->onDelete('cascade');

                // $table->foreign('tag_prefix_id')->references('ar_tag_prefixes')->on('id')->onDelete('cascade');
                // $table->foreign('pulling_units_id')->references('ar_pulling_units')->on('id')->onDelete('cascade');
                // $table->foreign('vehicle_use_type_id')->references('ar_vehicle_use_types')->on('id')->onDelete('cascade');
                // $table->foreign('reg_type_id')->references('ar_registration_types')->on('id')->onDelete('cascade');
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
        Schema::dropIfExists('ar_trailer_fees');
    }
}
