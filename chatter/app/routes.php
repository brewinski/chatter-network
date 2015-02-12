<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('post');
});

Route::get('post/post_comment/{id}', 'PostController@getPostComment');

Route::post('user/login', array('as' => 'user.login', 'uses' => 'UserController@login'));

Route::get('login_form', array('as' => 'user.login_form', 'uses' => 'UserController@login_form'));

Route::get('user/logout', array('as' => 'user.logout', 'uses' => 'UserController@logout'));

Route::post('seach_users', array('as' => 'user.search', 'uses' => 'UserController@listAll'));

Route::post('user/add_friend/{user_id}', array('as' => 'user.add_friend', 'uses' => 'UserController@add_friend'));

Route::post('user/remove_friend/{user_id}', array('as' => 'user.remove_friend', 'uses' => 'UserController@remove_friend'));

Route::post('user/get_friends/{id}', array('as' => 'user.get_friends', 'uses' => 'UserController@get_friends'));

Route::get('page/doc', array('as' => 'page.doc', 'uses' => 'UserController@doc'));

Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController');
Route::resource('user', 'UserController');
