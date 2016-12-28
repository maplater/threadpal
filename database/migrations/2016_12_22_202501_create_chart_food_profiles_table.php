<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartFoodProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_food_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('Beer');
            $table->integer('Distilled Spirits');
            $table->integer('Wine');
            $table->integer('Coffee');
            $table->integer('Cooking');
            $table->integer('Vegetarian');
            $table->integer('Vegan');
            $table->integer('Fast Food');
            $table->integer('Organic Food');
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
        Schema::drop('chart_food_profiles');
    }
}

