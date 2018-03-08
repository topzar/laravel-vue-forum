<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'experience', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function isOwner($object)
    {
        return $this->id == $object->user_id;
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * 用户和用户的关注关系 多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function followersUser()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * 关注摸一个用户
     * @param $user
     * @return array
     */
    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }

    /**
     * 用户和用户关注问题的关系 多对多 BelongsToMany
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class, 'follow_question')->withTimestamps();
    }

    /**
     * 关注问题 toggle 方法（自动删减和递增）
     * @param $question
     * @return array
     */
    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * 是否关注某一个问题
     * @param $question
     * @return int
     */
    public function followed($question)
    {
        return $this->follows()->where('question_id', $question)->count();
    }

    public function votes()
    {
        return $this->belongsToMany(Answer::class, 'votes')->withTimestamps();
    }

    public function hasVotedForThis($answer)
    {
        return !!$this->votes()->where('answer_id', $answer)->count();
    }

    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }
}
