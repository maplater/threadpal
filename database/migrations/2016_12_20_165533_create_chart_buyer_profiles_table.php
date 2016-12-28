<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartBuyerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_buyer_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('Coupon Users');
            $table->integer('DIYers');
            $table->integer('Fashionistas');
            $table->integer('Gamers');
            $table->integer('Healthy and fit');
            $table->integer('Foodies');
            $table->integer('Outdoor enthusiasts');
            $table->integer('Gadget enthusiast');
            $table->integer('Trendy homemakers');
            $table->integer('Sportsmen');
            $table->integer('Green living');
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
        Schema::drop('chart_buyer_profiles');
    }
}
