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
//This Route is set to GET your homepage when visitors come to the website
Route::get('/', function()
{
	return View::make('index');

	/*return "Hello! We are glad you've here. This is a place where you can store and keep track of personal goals!
	Once you're goals have been created, they act as a journal of all the things you've
	deemed important enough to keep track of. Welcome to SILO!";
*/

});

//Display form for new goal
Route::get('/index', function()
{
	return View::make('index');

});

Route::get('/goals/{query?}', function($query)

{
	return View::make('goals');
});


//Display form for new goal
Route::get('/add', function()
{


});

//Process form for new goal
Route::post('/add', function()
{


});


//Display form for edit a goal
Route::get('/edit/{goal}', function($goal)
{


});

//Process form after editing goal
Route::post('/edit', function($goal)
{


});

//Display form for edit a goal
Route::get('/data', function()
{

	$books = File::get(app_path().'/database/books.json');

//Convert to an array
	$books = json_decode($books,true);

	//returns file
//return $books;

	echo Pre::render($books);

});



/* Route::get('/bye', function()
{
	//return View::make('hello');

	return "Bye world";
});

Route::get('/books', function()
{
return "Here are all the books...";

});

Route::get('/books/{category}', function($category)

{

	return "Here are the books in the Category: ".$category;
});

Route::get('/new', function() {

    $view  = '<form method="POST">';
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;

});

Route::post('/new', function() {

    $input =  Input::all();
    print_r($input);

});*/