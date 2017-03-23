<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages',function($table){
            $table->increments('id');
            $table->integer('from');
            $table->integer('to');
            $table->string('message');
            $table->integer('message_type');
            $table->integer('case_id');
            $table->integer('read');
            $table->string('subject');
            $table->boolean('active')->default(1);
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
        Schema::drop('messages');
    }
}
