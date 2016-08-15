<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasTagPrefixes extends Migration
{

    /**
     * AA
     * ST
     * PT
     * T
     */
    public function up()
    {
        if (!Schema::hasTable('ar_tag_prefixes')) {
            Schema::create('ar_tag_prefixes', function (Blueprint $table) {
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
        Schema::dropIfExists('ar_tag_prefixes');
    }
}
