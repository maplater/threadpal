<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartUsGeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_us_geo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('New York');
            $table->integer('Albuquerque');
            $table->integer('Atlanta');
            $table->integer('Austin');
            $table->integer('Baltimore');
            $table->integer('Boston');
            $table->integer('Charlotte');
            $table->integer('Chicago');
            $table->integer('Cleveland');
            $table->integer('Colorado Springs');
            $table->integer('Columbus');
            $table->integer('Dallas');
            $table->integer('Denver');
            $table->integer('Detroit');
            $table->integer('Fort Worth');
            $table->integer('Fresno');
            $table->integer('Houston');
            $table->integer('Indianapolis');
            $table->integer('Jacksonville');
            $table->integer('Kansas City');
            $table->integer('Las Vegas');
            $table->integer('Long Beach');
            $table->integer('Los Angeles');
            $table->integer('Louisville');
            $table->integer('Memphis');
            $table->integer('Mesa');
            $table->integer('Miami');
            $table->integer('Milwaukee');
            $table->integer('Minneapolis');
            $table->integer('Nashville');
            $table->integer('New Orleans');
            $table->integer('Oakland');
            $table->integer('Oklahoma City');
            $table->integer('Omaha');
            $table->integer('Philadelphia');
            $table->integer('Phoenix');
            $table->integer('Portland');
            $table->integer('Raleigh');
            $table->integer('Sacramento');
            $table->integer('San Antonio');
            $table->integer('San Diego');
            $table->integer('San Francisco');
            $table->integer('San Jose');
            $table->integer('Seattle');
            $table->integer('Tucson');
            $table->integer('Tulsa');
            $table->integer('Virginia Beach');
            $table->integer('Washington');
            $table->integer('Wichita');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chart_us_geo');
    }
}
