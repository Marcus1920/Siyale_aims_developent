<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('cases_owners',function($table){
            $table->increments('id');
            $table->integer('case_id');
            $table->integer('user');
            $table->integer('type');
            $table->integer('accept');
            $table->integer('addressbook');
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
        Schema::drop('cases_owners');
    }
}
