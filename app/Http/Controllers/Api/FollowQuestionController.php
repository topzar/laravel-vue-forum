<?php

namespace App\Http\Controllers\Api;

use App\Question;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowQuestionController extends Controller
{

    public function followed(Request $request)
    {
        $user = Auth::guard('api')->user();

        $followed = $user->followed($request->get('question'));

        if ($followed) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    public function follow(Request $request)
    {

        $user = Auth::guard('api')->user();

        $question = Question::find($request->get('question'));
        //toggle方法是返回 attached(插入)和detached(删除)操作
        $follow = $user->followThis($request->get('question'));


        if (count($follow['detached'])  > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }

        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
