<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_relationship', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('Single');
            $table->integer('In a Relationship');
            $table->integer('Married');
            $table->integer('Engaged');
            $table->integer('In a Civil Union');
            $table->integer('In a Domestic Partnership');
            $table->integer('In an Open Relationship');
            $table->integer('Separated');
            $table->integer('Divorced');
            $table->integer('Widowed');
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
        Schema::drop('chart_relationship');
    }
}
