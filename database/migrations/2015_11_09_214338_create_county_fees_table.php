<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountyFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('county_fees')) {
            Schema::create('county_fees', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string("county_code");
                $table->integer("fee_id")->unsigned();
                $table->float('amount')->default(0.00);
                // $table->date('effective_date');
                $table->date('start_date');
                $table->date('end_date');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('county_fees');
    }
}
