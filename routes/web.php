<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'Home\QuestionsController@index');
Route::get('/test', 'HomeController@test');
Route::get('@{username}', 'HomeController@userHome')->name('user.home');

Route::get('email/confirm', 'EmailController@confirm')->name('email_confirm');
Route::get('email/test', 'EmailController@test')->name('email_confirm');

Auth::routes();

Route::group(['namespace'=> 'Home'], function () {

    Route::get('/home', 'indexController@index')->name('home');

    Route::resource('question', 'QuestionsController',['names' => [
        'create' => 'question.create',
        'show' => 'question.show',
    ]]);

    Route::post('question/{id}/answer', 'AnswerController@store')->name('question.answer');
    Route::get('question/{id}/follow', 'QuestionFollowController@follow')->name('question.follow');

    Route::get('topic/{id}', 'TopicController@show')->name('topic.show');

    Route::get('@{username}/notifications', 'NotificationController@index')->name('notifications');
    Route::get('@{username}/notifications/all', 'NotificationController@all')->name('notifications.all');
    Route::get('notifications/{notification}', 'NotificationController@show')->name('notifications.read');

    Route::get('@{username}', 'UserController@home')->name('user.home');
    Route::get('@{username}/avatar', 'UserController@avatar')->name('user.avatar');
    Route::post('/avatar', 'UserController@qiniu')->name('user.setAvatar');

    Route::get('@{username}/password', 'UserController@password')->name('user.password');
    Route::post('@{username}/password', 'UserController@changePassword')->name('user.changePassword');
});
