<?php

namespace App\Http\Controllers\Api;

use App\FollowQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FollowQuestionController extends Controller
{

    public function followed(Request $request)
    {
        $followed = DB::table('follow_question')->where([
            'question_id' => $request->get('question'),
            'user_id' => $request->get('user')
        ])->count();

        if ($followed) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    public function follow(Request $request)
    {
        $follow = FollowQuestion::where('question_id', $request->get('question'))
            ->where('user_id', $request->get('user'))
            ->first();

        if ($follow !== null) {
            $follow->delete();
            return response()->json(['followed' => false]);
        }

        FollowQuestion::create([
            'question_id' => $request->get('question'),
            'user_id' => $request->get('user')
        ]);

        return response()->json(['followed' => true]);
    }
}
