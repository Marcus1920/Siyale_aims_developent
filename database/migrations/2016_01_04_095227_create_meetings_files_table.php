<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings_files',function($table){
            $table->increments('id');
            $table->integer('meeting_id');
            $table->integer('user');
            $table->string('file');
            $table->integer('addressbook');
            $table->string('file_note');
            $table->string('img_url');
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
         Schema::drop('meetings_files');
    }
}
