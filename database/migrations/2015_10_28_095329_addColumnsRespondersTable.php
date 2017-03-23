<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsRespondersAlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       \DB::statement('ALTER TABLE `responders` MODIFY COLUMN `first_responder`VARCHAR(255)');
       \DB::statement('ALTER TABLE `responders` MODIFY COLUMN `second_responder`VARCHAR(255)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
