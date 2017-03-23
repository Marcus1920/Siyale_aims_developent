<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poi_vehicles',function($table){
            $table->increments('id');
            $table->integer('poi_id');
            $table->string('vehicle_make');
            $table->string('vehicle_color');
            $table->string('vehicle_vin');
            $table->string('vehicle_plate');
            $table->integer('created_by');
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
        Schema::drop('poi_vehicles');
        
    }
}
