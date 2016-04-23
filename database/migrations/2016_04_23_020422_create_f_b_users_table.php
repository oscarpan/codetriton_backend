<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFBUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_b_users', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('name');
            $table->string('email');
            $table->string('image');
            $table->text('details');
            $table->integer('points')->default(1000);
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
        Schema::drop('f_b_users');
    }
}
