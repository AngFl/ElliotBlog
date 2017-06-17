<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('avatar')->nullable();

            $table->string('email')->unique();
            $table->string('password');
            $table->string('description')->nullable();

            //邮件注册字符
            $table->string('confirm_code');
            $table->integer('is_active')->default(0);

            // 授权登录信息系列
            $table->integer('oauth_id')->default(0);
            $table->string('oauth_name')->nullable();
            $table->string('oauth_access_token')->nullable();
            // 过期时间
            $table->integer('oauth_expires')->unsigned();

            //$table->integer('confirm_code');
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
        Schema::drop('users');
    }
}
