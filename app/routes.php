<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Register all of the routes for the application.
|
*/


/*
 *
 * Public Site Routes
 *
 */
Route::get(     '/',                        ['as' => 'pages.home',              'uses' => 'PagesController@showHomePage']);
Route::get(     '/about',                   ['as' => 'pages.about',              'uses' => 'PagesController@showAboutPage']);
Route::get(     '/about/ultimate',          ['as' => 'pages.about.ultimate',    'uses' => 'PagesController@']);
Route::get(     '/about/scu',               ['as' => 'pages.about.scu',         'uses' => 'PagesController@']);
Route::get(     '/about/scu_leaders',       ['as' => 'pages.about.scu_leaders', 'uses' => 'PagesController@']);
Route::get(     '/news',                    ['as' => 'pages.news', 'uses' => 'PagesController@showNewsPage']);
Route::get(     '/contactus',               ['as' => 'pages.contactus', 'uses' => 'PagesController@contactus']);

/*
 *
 * Session Routes
 *
 */
Route::get(     'signin',       ['as' => 'sessions.create', 'uses' => 'SessionsController@create']);
Route::post(    'signin',       ['as' => 'sessions.signin', 'uses' => 'SessionsController@signIn']);
Route::get(     'signout',      ['as' => 'sessions.signout', 'uses' => 'SessionsController@signOut']);

/**
 *
 * New Member Routes
 *
 **/
Route::get(     'members/register',                   ['as' => 'members.register', 'uses' => 'MembersController@create']);
Route::post(    'members/register',                   ['as' => 'members.store', 'uses' => 'MembersController@register']);
Route::get(     'members/verify',                     ['as' => 'members.verifyForm', 'uses' => 'MembersController@resetVerificationCodeForm']);
Route::post(    'members/verify',                     ['as' => 'members.resetVerify', 'uses' => 'MembersController@resetVerificationCode']);
Route::get(     'members/verify/{confirmation_code}', ['as' => 'members.verify', 'uses' => 'MembersController@verify']);

/**
 *
 * Password Routes
 *
 **/
Route::get(     'password/reminder',                ['as' => 'password.reminder', 'uses' => 'RemindersController@getRemind']);
Route::post(    'password/remind',                  ['as' => 'password.remind', 'uses' => 'RemindersController@postRemind']);
Route::get(     'password/reset/{token}',           ['as' => 'password.resetForm', 'uses' => 'RemindersController@getReset']);
Route::post(    'password/reset',                   ['as' => 'password.reset', 'uses' => 'RemindersController@postReset']);

Route::group(array('before' => 'auth'), function()
{
    /**
     *
     *  Member Routes
     *
     **/
    Route::get(     'members/dashboard',    ['as' => 'members.dashboard', 'uses' => 'MembersController@dashboard']);
    Route::get(     'members',              ['as' => 'members.list', 'uses' => 'MembersController@index']);
    Route::get(     'members/{id}',         ['as' => 'members.view', 'uses' => 'MembersController@show']);
    Route::get(     'members/{id}/edit',    ['as' => 'members.edit', 'uses' => 'MembersController@edit']);
    Route::patch(   'members/{id}',         ['as' => 'members.update', 'uses' => 'MembersController@update']);
    Route::delete(  'members/{id}',         ['as' => 'members.destroy', 'uses' => 'MembersController@destroy']);
});
/*
 * Posts Routes
 */
Route::get(     'posts',            ['as' => 'posts.list', 'uses' => 'PostsController@index']);
Route::get(     'posts/create',     ['as' => 'posts.create', 'uses' => 'PostsController@create']);
Route::post(    'posts',            ['as' => 'posts.store', 'uses' => 'PostsController@store']);
Route::get(     'posts/{id}',       ['as' => 'posts.view', 'uses' => 'PostsController@show']);
Route::get(     'posts/{id}/edit',  ['as' => 'posts.edit', 'uses' => 'PostsController@edit']);
Route::patch(   'posts/{id}',       ['as' => 'posts.update', 'uses' => 'PostsController@update']);
Route::put(     'posts/{id}',       ['as' => 'posts.put', 'uses' => 'PostsController@update']);
Route::delete(  'posts/{id}',       ['as' => 'posts.destroy', 'uses' => 'PostsController@destroy']);

/*
 * Events Routes
 */
Route::get(     'events',            ['as' => 'events.list', 'uses' => 'EventsController@index']);
Route::get(     'events/create',     ['as' => 'events.create', 'uses' => 'EventsController@create']);
Route::post(    'events',            ['as' => 'events.store', 'uses' => 'EventsController@store']);
Route::get(     'events/{id}',       ['as' => 'events.view', 'uses' => 'EventsController@show']);
Route::get(     'events/{id}/edit',  ['as' => 'events.edit', 'uses' => 'EventsController@edit']);
Route::patch(   'events/{id}',       ['as' => 'events.update', 'uses' => 'EventsController@update']);
Route::put(     'events/{id}',       ['as' => 'events.put', 'uses' => 'EventsController@update']);
Route::delete(  'events/{id}',       ['as' => 'events.destroy', 'uses' => 'EventsController@destroy']);

/*
 * Team Routes
 */
Route::get(     'teams',            ['as' => 'teams.list', 'uses' => 'TeamsController@index']);
Route::get(     'teams/create',     ['as' => 'teams.create', 'uses' => 'TeamsController@create']);
Route::post(    'teams',            ['as' => 'teams.store', 'uses' => 'TeamsController@store']);
Route::get(     'teams/{id}',       ['as' => 'teams.view', 'uses' => 'TeamsController@show']);
Route::get(     'teams/{id}/edit',  ['as' => 'teams.edit', 'uses' => 'TeamsController@edit']);
Route::patch(   'teams/{id}',       ['as' => 'teams.update', 'uses' => 'TeamsController@update']);
Route::put(     'teams/{id}',       ['as' => 'teams.put', 'uses' => 'TeamsController@update']);
Route::delete(  'teams/{id}',       ['as' => 'teams.destroy', 'uses' => 'TeamsController@destroy']);




