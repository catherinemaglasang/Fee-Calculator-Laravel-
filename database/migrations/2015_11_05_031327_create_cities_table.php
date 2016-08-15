<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('county_id')->unsigned();
                $table->string('code');
                $table->string('name');
                $table->string('slug');
                $table->unique(['name', 'slug', 'county_id'], 'name_slug_county_unique');
                $table->index('name');
                $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
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
        Schema::dropIfExists('cities');
    }
}
