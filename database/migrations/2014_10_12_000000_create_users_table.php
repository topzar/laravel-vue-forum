<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name')->unique()->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password');
            $table->string('avatar')->default('/resources/images/default.jpg')->comment('用户头像');
            $table->string('confirmation_token')->comment('激活标识');
            $table->integer('questions_count')->default(0)->comment('问题总数');
            $table->integer('answers_count')->default(0)->comment('答案总数');
            $table->integer('comments_count')->default(0)->comment('评论总数');
            $table->integer('favorites_count')->default(0)->comment('收藏总数');
            $table->integer('likes_count')->default(0)->comment('点赞总数');
            $table->integer('followers_count')->default(0)->comment('关注者总数');
            $table->integer('followings_count')->default(0)->comment('关注总数');
            $table->smallInteger('is_active')->default(0)->comment('是否激活');
            $table->integer('experience')->comment('积分');
            $table->enum('sex', ['male', 'female']);
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
        Schema::dropIfExists('users');
    }
}
