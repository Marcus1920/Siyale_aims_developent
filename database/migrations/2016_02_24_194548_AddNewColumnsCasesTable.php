<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsCasesTable extends Migration
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

            $table->integer('case_type');
            $table->integer('case_sub_type');
            $table->string('saps_case_number');

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
            $table->dropColumn('case_type');
            $table->dropColumn('case_sub_type');
            $table->dropColumn('saps_case_number');

        });
    }
}
