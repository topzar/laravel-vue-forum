<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * 问题话话题的关联关系 多堆多
     * 用法 $question->topics
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    /**
     * 问题和用户的关联关系 一对一
     * 用法 $question->user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 问题和答案的关联关系 一对多hasMany
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * 问题的关注者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_question')->withTimestamps();
    }

    /**
     * 过滤指定字段 scope属性
     * 用法 ORM::notHidden()
     * @param $query
     * @return mixed
     */
    public function scopeNotHidden($query)
    {
        return $query->where('is_hidden', 0);
    }
}
