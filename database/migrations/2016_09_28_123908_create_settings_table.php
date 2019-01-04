<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->string('name');
            $table->string('bus_no');
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->string('location');
            $table->text('notification');
            $table->integer('size');
            $table->string('color');
            $table->string('logo');
            $table->integer('over_time');
            $table->integer('missed_time');
            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
