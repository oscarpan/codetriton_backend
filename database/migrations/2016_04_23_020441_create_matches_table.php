<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->bigInteger('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('f_b_users');
            $table->bigInteger('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('f_b_users');
            $table->boolean('approval');
            $table->integer('host_rating');
            $table->integer('guest_rating');
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
        Schema::drop('matches');
    }
}
