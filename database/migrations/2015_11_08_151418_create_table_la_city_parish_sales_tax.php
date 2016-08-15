<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLaCityParishSalesTax extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('la_city_parish_sales_tax')) {
            Schema::create('la_city_parish_sales_tax', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('county_id')->unsigned();
                $table->integer('city_id')->unsigned();
                $table->date('start_date');
                $table->date('end_date');
                $table->date('area_effective_date');
                $table->date('parish_effective_date');
                $table->double('area_tax');
                $table->double('area_vendor_desc');
                $table->double('parish_tax');
                $table->double('parish_vendor_desc');

                // Removed because there are PARISH ONLY rates.
                // $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
                // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('la_city_parish_sales_tax');
    }
}
