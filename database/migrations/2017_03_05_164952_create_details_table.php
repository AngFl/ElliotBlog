<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->string('title');
            // 笔记
            $table->string('note');
            // 作者
            $table->string('author');
            // 内容
            $table->text('content');

            // 点赞数量
            $table->integer('thumbs_up')->unsigned()->default(0);
            //b_cmt_num   Int                    被评论数
            // - b_status  Int                   是否被移入草稿

            $table->integer('comment_int')->default(0);
            $table->integer('status')->default(0);

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::drop('details');
    }
}
