<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiDriverLicences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poi_driver_licences',function($table){
            $table->increments('id');
            $table->integer('poi_id');
            $table->string('driver_licence_code');
            $table->datetime('drivers_licence_date_issued');
            $table->datetime('drivers_licence_expiry_date');  
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
        Schema::drop('poi_driver_licences');
    }
}
