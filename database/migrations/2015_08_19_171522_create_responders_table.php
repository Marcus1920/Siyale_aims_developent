<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespondersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responders',function($table){
            $table->increments('id');
            $table->integer('department');
            $table->integer('category');
            $table->integer('sub_category');
            $table->integer('sub_sub_category');
            $table->integer('first_responder');
            $table->integer('second_responder');
            $table->integer('third_responder');
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
        Schema::drop('responders');
    }
}
