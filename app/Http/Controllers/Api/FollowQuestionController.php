<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\FollowQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FollowQuestionController extends Controller
{

    public function followed(Request $request)
    {
        $user = Auth::guard('api')->user();
        //return response()->json($user);

        $followed = DB::table('follow_question')->where([
            'question_id' => $request->get('question'),
            'user_id' => $user->id
        ])->count();

        if ($followed) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    public function follow(Request $request)
    {

        $user = Auth::guard('api')->user();

        $follow = FollowQuestion::where('question_id', $request->get('question'))
            ->where('user_id', $user->id)
            ->first();

        if ($follow !== null) {
            $follow->delete();
            return response()->json(['followed' => false]);
        }

        FollowQuestion::create([
            'question_id' => $request->get('question'),
            'user_id' => $user->id
        ]);

        return response()->json(['followed' => true]);
    }
}
