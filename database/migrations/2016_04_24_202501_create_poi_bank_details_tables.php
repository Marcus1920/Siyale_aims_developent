<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoiBankDetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('poi_bank_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poi_id');
            $table->integer('bank_id');
            $table->string('account_name');
            $table->string('branch_code');
            $table->string('account_number');
            $table->string('account_1');
            $table->string('account_2');
            $table->string('account_3');
            $table->string('account_4');
            $table->string('account_5');
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
        Schema::drop('poi_bank_details');

    }
}
