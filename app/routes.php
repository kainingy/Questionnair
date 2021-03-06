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
	return View::make('hello');
});

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('Question', 'Question');
Route::model('Questionnair', 'Questionnair');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('Question', '[0-9]+');
Route::pattern('Questionnair', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    // # Question Management
     Route::get('questions/{question}/edit', 'AdminQuestionsController@getEdit');
     Route::post('questions/{question}/edit', 'AdminQuestionsController@postEdit');
     Route::get('questions/{question}/delete', 'AdminQuestionsController@getDelete');
     Route::post('questions/{question}/delete', 'AdminQuestionsController@postDelete');
    // Route::controller('questions', 'AdminQuestionsController');

    # Questionnair Management
    Route::get('questionnairs/{questionnair}/show', 'AdminQuestionnairsController@getShow');
    Route::get('questionnairs/{questionnair}/edit', 'AdminQuestionnairsController@getEdit');
    Route::post('questionnairs/{questionnair}/edit', 'AdminQuestionnairsController@postEdit');
    Route::get('questionnairs/{questionnair}/delete', 'AdminQuestionnairsController@getDelete');
    Route::post('questionnairs/{questionnair}/delete', 'AdminQuestionnairsController@postDelete');
    Route::controller('questionnairs', 'AdminQuestionnairsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

