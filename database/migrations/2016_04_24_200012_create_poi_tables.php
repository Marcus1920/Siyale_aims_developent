<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->integer('id_number');
            $table->integer('gender');
            $table->integer('nationality');
            $table->string('nickname');
            $table->string('language');
            $table->string('drivers_licence');
            $table->integer('marital_status_id');
            $table->string('address_home');
            $table->string('address_work');
            $table->string('contact_number_1');
            $table->string('contact_number_2');
            $table->string('contact_number_3');
            $table->string('email')->unique();
            $table->integer('ethnic_group_id');
            $table->string('birth_place');
            $table->string('weight');
            $table->string('height');
            $table->string('scars');
            $table->string('tattoo');
            $table->string('picture');
            $table->string('crime_type_1');
            $table->string('crime_type_2');
            $table->string('crime_type_3');
            $table->string('crime_type_4');
            $table->string('crime_type_5');
            $table->string('arrest_record_1');
            $table->string('arrest_record_2');
            $table->string('arrest_record_3');
            $table->string('arrest_record_4');
            $table->string('arrest_record_5');
            $table->text('credit_record');
            $table->string('property_owned_1');
            $table->string('property_owned_2');
            $table->string('property_owned_3');
            $table->string('property_rented_1');
            $table->string('property_rented_2');
            $table->string('property_rented_3');
            $table->integer('dependants');
            $table->text('travel_movements');
            $table->text('employment_history');
            $table->integer('bank_details_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->boolean('active')->default(1);
            $table->rememberToken();
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
        Schema::drop('poi');

    }
}
