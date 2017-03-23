<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPoiAddresses extends Migration
{
      public function up()
    {
        Schema::table('poi_addresses', function($table)
        {

            $table->string('street_number');
            $table->string('route');
            $table->string('locality');
            $table->string('administrative_area_level_1');
            $table->string('postal_code');
            $table->string('gps_lat');
            $table->string('gps_lng');
            $table->string('date_seen');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poi_addresses', function($table)
        {

            $table->dropColumn('street_number');
            $table->dropColumn('route');
            $table->dropColumn('locality');
            $table->dropColumn('administrative_area_level_1');
            $table->dropColumn('postal_code');
            $table->dropColumn('gps_lat');
            $table->dropColumn('gps_lng');
            $table->dropColumn('date_seen');
            

        });
    }
}


