<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('login', 'API\UserController@login');

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('user_details', 'API\UserController@details');
	Route::post('inteception_start', 'API\UserController@interception_start');
	Route::post('inteception_answer', 'API\UserController@interception_add_answer_middleware');
	Route::post('inteception_feedback', 'API\UserController@feedback_add');
	Route::post('activity_log', 'API\UserController@activity_log');
	// Route::post('get_questions', 'API\UserController@get_questions');
	Route::get('get_interceptions', 'API\UserController@get_interceptions');
	Route::get('get_feedbacks/{interception_id}', 'API\UserController@get_feedbacks');
	Route::get('get_previous_answers/{interception_id}', 'API\UserController@get_previous_answers');
});
