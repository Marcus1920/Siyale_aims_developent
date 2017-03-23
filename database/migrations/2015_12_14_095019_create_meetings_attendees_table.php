<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings_attendees',function($table){

            $table->increments('id');
            $table->integer('meeting');
            $table->integer('attendee');
            $table->integer('phonebook');
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
        Schema::drop('meetings_attendees');
    }
}
