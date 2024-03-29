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
    'middleware' => ['auth:api']
], function() {

    Route::post('question/followed', 'FollowQuestionController@followed');
    Route::post('question/follow', 'FollowQuestionController@follow');

    Route::get('user/{user}/followed', 'FollowUserController@followed');
    Route::post('user/follow', 'FollowUserController@follow');

    Route::post('answer/{id}/voted', 'VotesController@voted');
    Route::post('answer/vote', 'VotesController@vote');

    Route::post('message/store', 'MessageController@store');

    Route::get('answer/{id}/comments', 'CommentsController@answer');
    Route::get('question/{id}/comments', 'CommentsController@question');

    Route::post('comment/create', 'CommentsController@store');

});

Route::group([
    'namespace' => 'Api'
], function() {

    Route::get('answer/{id}/comments', 'CommentsController@answer');
    Route::get('question/{id}/comments', 'CommentsController@question');

});
