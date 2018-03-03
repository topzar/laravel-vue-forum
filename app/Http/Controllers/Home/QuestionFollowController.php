<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Http\Controllers\Controller;

class QuestionFollowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow($question)
    {
        //dd($question);
        Auth::user()->followThis($question);

        //TODO 更新问题的被关注数

        return back();
    }

}
