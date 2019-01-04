<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('queue_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('counter_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('number');
            $table->date('called_date');
            $table->timestamps();

            $table->foreign('queue_id')->references('id')->on('queues');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('counter_id')->references('id')->on('counters');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calls');
    }
}
