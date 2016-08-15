<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('counties')) {
            Schema::create('counties', function (Blueprint $table) {
                $table->increments('id');
                $table->string('state_code');
                $table->string('code');
                $table->string('name');
                $table->string('slug');
                $table->index('name'); // Because name is probably the most searched term in county.
                $table->unique(['state_code', 'slug'], 'slug_state_code_unique');
                $table->boolean('is_parish')->default(false);
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
        Schema::dropIfExists('counties');
    }
}
