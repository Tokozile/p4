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
	return View::make('index')
	->with('name', 'Sibo');
});

Route::get('/signup', function()
{
	return View::make('signup');

});

Route::get('/login', function()
{
	return View::make('login');

});


//Determines search results format
Route::get('/goals/{format?}', function($format = 'html')
{

$books = File::get(app_path().'/database/books.json');

//Convert to an array
	$books = json_decode($books,true);

if ($format == 'excel') {
 	return 'Excel Version';
 } 

 elseif (strtolower($format) == 'pdf') {
 	return 'PDF Version';
 }

 else {
	return View::make('goals')
		->with('name', 'Sibo')
		->with('books', $books);

	}
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
Route::get('/data{format?}', function($format = 'html')
{

	$query = Input::get('query');

/*	if ($query == 'maya') {
		return 'hello world';
	}*/

$books = File::get(app_path().'/database/books.json');

//Convert to an array
	$books = json_decode($books,true);

if ($format == 'excel') {
 	return 'Excel Version';
 } 

 elseif (strtolower($format) == 'pdf') {
 	return 'PDF Version';
 }

 else {
	return View::make('goals')
		->with('name', 'Sibo')
		->with('books', $books)
		->with('query', $query);

	}

/*$library = new Library();

$library->setPath(app_path().'/database/books.json');
$books = $library->getBooks();

	//returns file
	echo Pre::render($books);*/

});

Route::get('/profile', function()
{
	return View::make('profile');

});


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

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

# /app/routes.php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});