<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('states')) {
            Schema::create('states', function (Blueprint $table) {            
                $table->string('code', 7)->primary();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->integer('priority');
                $table->string('country_code', 5)->default('US');
                $table->index('code');
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
        Schema::dropIfExists('states');
    }
}
