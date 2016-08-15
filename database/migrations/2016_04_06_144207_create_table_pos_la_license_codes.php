<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosLaLicenseCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pos_la_license_codes')) {
            Schema::create('pos_la_license_codes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('code')->unique();
                $table->integer('priority');

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
        Schema::dropIfExists('pos_la_license_codes');
    }
}
