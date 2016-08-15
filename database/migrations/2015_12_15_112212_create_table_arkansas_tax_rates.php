<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArkansasTaxRates extends Migration
{

    /**
     * SELECT
        cn.`name` AS CNTY_NM,
        CONCAT(CONCAT(c.`code`, '-'), cn.`code`) AS CountyCityID,
        c.`name` AS CITY_NM,
        arx.`city_rate` AS CITY_RATE_AMT,
        arx.`county_rate` AS CNTY_RATE_AMT,
        arx.`county_rate` AS STATE_RATE,
        arx.`start_date`,
        arx.`end_date`
        FROM
        ar_tax_rates arx
        INNER JOIN cities c
        ON arx.`city_id` = c.id
        INNER JOIN counties cn
        ON cn.`id` = c.`county_id`
     */
    public function up()
    {
        if (!Schema::hasTable('ar_tax_rates')) {
            Schema::create('ar_tax_rates', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('city_id')->unsigned();
                $table->double('county_rate');
                $table->double('city_rate');
                $table->double('state_rate');
                $table->date('start_date');
                $table->date('end_date');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('ar_tax_rates');
    }
}
