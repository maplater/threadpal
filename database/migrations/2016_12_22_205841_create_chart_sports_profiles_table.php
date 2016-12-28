<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartSportsProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_sports_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('Football');
            $table->integer('Soccer');
            $table->integer('Baseball');
            $table->integer('Basketball');
            $table->integer('Golf');
            $table->integer('Skiing');
            $table->integer('Tennis');
            $table->integer('Mixed Martial Arts');
            $table->integer('Auto Racing');
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
        Schema::drop('chart_sports_profiles');
    }
}
