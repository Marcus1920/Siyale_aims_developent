<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnscases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function($table)
        {

            $table->string('investigation_cell');
            $table->string('investigation_email');
            $table->string('investigation_note');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cases', function($table)
        {

            $table->dropColumn('investigation_cell');
            $table->dropColumn('investigation_email');
            $table->dropColumn('investigation_note');
            

        });
    }
}
