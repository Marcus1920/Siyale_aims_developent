<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addressbook',function($table){
            $table->increments('id');
            $table->integer('user');
            $table->integer('relationship');
            $table->string('email')->unique();
            $table->string('cellphone')->unique();
            $table->string('first_name');
            $table->string('surname');
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
         Schema::drop('addressbook');
    }
}
