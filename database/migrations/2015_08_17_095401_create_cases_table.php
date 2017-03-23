<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases',function($table){
            $table->increments('id');
            $table->string('description');
            $table->integer('user');
            $table->integer('department');
            $table->integer('province');
            $table->integer('district');
            $table->integer('municipality');
            $table->integer('ward');
            $table->string('area');
            $table->integer('category');
            $table->integer('sub_category');
            $table->integer('sub_sub_category');
            $table->integer('priority');
            $table->integer('status');
            $table->string('gps_lat');
            $table->string('gps_lng');
            $table->string('img_url');
            $table->integer('addressbook');
            $table->integer('reporter');
            $table->integer('severity');
            $table->integer('source');
            $table->integer('busy');
            $table->dateTime('accepted_at');
            $table->dateTime('referred_at');
            $table->dateTime('escalated_at');
            $table->dateTime('resolved_at');
            $table->dateTime('closed_at');
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
         Schema::drop('cases');
    }
}
