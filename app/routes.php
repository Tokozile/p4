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
/**
* User
* (Explicit Routing)
*/
Route::get('/signup','UserController@getSignup' );
Route::post('/signup', 'UserController@postSignup' );

Route::get('/login', 'UserController@getLogin' );
Route::post('/login', 'UserController@postLogin' );

Route::get('/logout', 'UserController@getLogout' );

/**
* User
* (Explicit Routing)
*/

Route::get('/note/add{id}', 'NoteController@getAdd');
Route::post('/note/add', 'NoteController@postAdd');

Route::get('/note/edit', 'NoteController@getEdit');
Route::post('/note/edit', 'NoteController@postEdit');
/**
* Debug
* (Implicit Routing)
*/
Route::controller('debug', 'DebugController');

Route::get('/', function()
{
    return View::make('index');

});


Route::get('/profile', function()
{
    return View::make('profile');

});

Route::get('/general', function()
{
    return View::make('general');

});

Route::get('/goal/showall', function()
{
    
    $goals = DB::table('goals')
           ->get();


                        $goalOutput = '';
                    #return the name and description of each goal for this user
                    foreach ($goals as $goal) 
                    {

                            $goalOutput .= View::make('goal_edit')->with('goal', $goal)->render();
                    }

                    return $goalOutput; 

});

Route::get('/goal/showmine', function()
{
    
#return Redirect::action('GoalController@getIndex')->with('flash_message','Your changes have been saved.');

    $goals = DB::table('goals')
           ->get();


                        $goalOutput = '';
                    #return the name and description of each goal for this user
                    foreach ($goals as $goal) 
                    {
                            #$goalOutput .= View::make('goal_edit')->with('goal', $goal)->render();

                            echo $goal->goal_completed;

                    }

                    #return $goalOutput; 

                    #return Redirect::action('GoalController@getIncomplete', 'GoalController@postComplete')->with('flash_message','Your goals...');

});

#return Redirect::action('GoalController@getIndex')->with('flash_message','Your changes have been saved.');

/**
* Goal
* (Explicit Routing)
*/
Route::get('/goal', 'GoalController@getIndex');

Route::get('/goal/search', 'GoalController@getSearch');
Route::post('/goal/search', 'GoalController@postSearch');

Route::get('/goal/complete', 'GoalController@getComplete');
Route::post('/goal/complete', 'GoalController@postComplete');

Route::get('/goal/incomplete', 'GoalController@getIncomplete');

Route::get('/goal/edit/{id}', 'GoalController@getEdit');
Route::post('/goal/edit', 'GoalController@postEdit');

Route::get('/goal/add', 'GoalController@getAdd');
Route::post('/goal/add', 'GoalController@postAdd');

Route::post('/goal/delete', 'GoalController@postDelete');

Route::post('/goal/sendEmail', 'GoalController@postGoalEmail');



