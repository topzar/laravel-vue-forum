<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowQuestion extends Model
{
    protected $table = 'follow_question';

    protected $fillable = ['user_id', 'question_id'];

}
