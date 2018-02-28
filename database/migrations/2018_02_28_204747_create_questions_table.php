<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->text('body')->comment('内容');
            $table->integer('user_id')->comment('发布者');
            $table->integer('comments_count')->default(0)->comment('评论总数');
            $table->integer('followers_count')->default(1)->comment('关注者总数');
            $table->integer('answers_count')->default(0)->comment('答案总数');
            $table->smallInteger('close_comment')->default(0)->comment('是否关闭评论 0否 1是');
            $table->smallInteger('is_hidden')->default(0)->comment('是否隐藏 0否 1是');
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
        Schema::dropIfExists('questions');
    }
}
