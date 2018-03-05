<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace' => 'Api',
    'middleware' => ['api']
], function() {

    Route::post('question/followed', 'FollowQuestionController@followed');
    Route::post('question/follow', 'FollowQuestionController@follow');

});

Route::middleware('api')->post('question/follower', function (Request $request) {

    $followed = \App\FollowQuestion::where('question_id', $request->get('question'))
        ->where('user_id', $request->get('user'))
        ->count();

    if ($followed){
        return response()->json([
            'followed' => true
        ]);
    }
    return response()->json([
        'followed' => false
    ]);
});

Route::middleware('api')->post('question/follow', function (Request $request) {

    $followed = \App\FollowQuestion::where('question_id', $request->get('question'))
        ->where('user_id', $request->get('user'))
        ->first();

    if ($followed !== null){
        $followed->delete();
        return response()->json([
            'followed' => false
        ]);
    }

    \App\FollowQuestion::create([
        'question_id' => $request->get('question'),
        'user_id' => $request->get('user')
    ]);

    return response()->json([
        'followed' => true
    ]);
});
