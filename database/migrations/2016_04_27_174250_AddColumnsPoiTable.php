<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poi', function($table)
        {

            $table->string('bank_name');
            $table->string('bank_holder_name');
            $table->string('bank_branch_code');
            $table->string('bank_account_number');
            $table->string('business_interest');
            $table->string('account_1');
            $table->string('account_2');
            $table->string('account_3');
            $table->string('account_4');
            $table->string('account_5');


        });
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
