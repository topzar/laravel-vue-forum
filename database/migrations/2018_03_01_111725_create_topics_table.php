<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',120)->comment('名称');
            $table->text('bio')->nullable()->comment('简介');
            $table->string('image')->nullable()->comment('缩略图');
            $table->integer('questions_count')->default(0)->comment('问题总数');
            $table->integer('followers_count')->default(0)->comment('关注者总数');
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
        Schema::dropIfExists('topics');
    }
}
