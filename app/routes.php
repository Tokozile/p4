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

Route::get('/notes', function($id) {

               /* #get all goals whose users_id matched the current user's id*/
           $goals = DB::table('goals')->where('id', '=', $id)
           ->get();
                        
                        $goalOutput = '';
                    #return the name and description of each goal for this user
                    foreach ($goals as $goal) 
                    {

                            $goalOutput .= View::make('goal_edit')->with('goal', $goal)->render();
                    }

                    return $goalOutput; 

});

Route::post('/notes', function()
{

    $note = DB::table('notes')->insert(array('notes' => Input::get('note'), 'goal_id' => Input::get('id')));

        #Add note values and save
/*      $note = new Note();
        $note->note = Input::get('note');
        $note->goal_id = Input::get('id');*/

        $note->save();




    });
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



