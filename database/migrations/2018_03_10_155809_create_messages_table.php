<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_user_id')->comment('发送者');
            $table->unsignedInteger('to_user_id')->comment('发送至');
            $table->text('body')->comment('内容');
            $table->smallInteger('has_read')->default(0)->comment('是否已读');
            $table->timestamp('read_at')->nullable()->comment('阅读时间');
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
        Schema::dropIfExists('messages');
    }
}
