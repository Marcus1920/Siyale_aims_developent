<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poi_addresses',function($table){
            $table->increments('id');
            $table->integer('type');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('line_3');
            $table->string('line_4');
            $table->integer('country');
            $table->integer('poi_id');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::drop('poi_addresses');
        
    }
}
