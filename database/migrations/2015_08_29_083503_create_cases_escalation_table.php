<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesEscalationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases_escalations',function($table){
            $table->increments('id');
            $table->integer('case_id');
            $table->integer('from');
            $table->integer('to');
            $table->integer('type');
            $table->string('message');
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
        Schema::drop('cases_escalations');
    }
}
