<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartTravelProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_travel_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('Frequent travelers');
            $table->integer('Frequent flyers');
            $table->integer('Business travelers');
            $table->integer('Commuters');
            $table->integer('International Travelers');
            $table->integer('Domestic Travel');
            $table->integer('Cruises');
            $table->integer('Family vacations');
            $table->integer('Timeshares');
            $table->integer('Leisure travelers');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chart_travel_profiles');
    }
}