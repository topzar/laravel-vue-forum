<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $fillable = ['name', 'question_id', 'topic_id'];

    /**
     * 话题和问题的关联关系
     * 用法 $topic->questions
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        /**
         *  belongsToMany 是声明多对多的关联关系 第二个参数是第三章关联表的名字 默认是两张表的单数形式 如question_topic
         * withTimestamps 是操作第三章表的created_at,updated_at字段
         */
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

}
