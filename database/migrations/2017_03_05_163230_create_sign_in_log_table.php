<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignInLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_in_log', function (Blueprint $table) {
            $table->increments('id');

            $table->string('email');
            $table->string('id_address');
            $table->date('last');
            /*
             *  - email       string(30)                 标识
                - ip_address   string(25)                 地址
                - last        Unsigned int               登录时间
             */
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
        Schema::drop('sign_in_log');
    }
}
