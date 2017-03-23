<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiCriminalRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poi_criminal_records',function($table){
            $table->increments('id');
            $table->text('description');
            $table->string('police_station');
            $table->string('investigation_officer');
            $table->string('investigation_officer_mobile_number');
            $table->text('sentence');
            $table->datetime('criminal_record_date');
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
        Schema::drop('poi_criminal_records');
    }
}
