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
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', 'UserController@postSignup' );
Route::post('/login', 'UserController@postLogin' );
Route::get('/logout', 'UserController@getLogout' );



/**
* Goal
* (Explicit Routing)
*/
Route::get('/goal', 'GoalController@getIndex');

Route::get('/goal/search', 'GoalController@getSearch');
Route::post('/goal/search', 'GoalController@postSearch');

Route::get('/goal/complete', 'GoalController@getSearch');
Route::get('/goal/incomplete', 'GoalController@postSearch');

Route::get('/goal/edit/{id}', 'GoalController@getEdit');
Route::post('/goal/edit', 'GoalController@postEdit');

/*Route::get('/goal/add', 'GoalController@getAdd');
Route::post('/goal/add', 'GoalController@postAdd');*/

Route::post('/goal/delete', 'GoalController@postDelete');


Route::get('/goal/add', function() {

        //$users= User::getIdNamePair();

        return View::make('goal_add')/*->with('users',$users)*/;

    });


    /**
    * Process the "Add a book form"
    * @return Redirect
    */
Route::post('/goal/add', function() {

        # Instantiate the book model
        $goal = new Goal();

/*        $goal->fill(Input::all());
        $goal->save();

        # Magic: Eloquent
        $goal->save();

        return View::make('goal_add')->with('flash_message','Your goal has been added.');*/

        $goal->name = Input::get('name');
        $goal->description = Input::get('description');

        try {
            $goal->save();
        }
        catch (Exception $e) {
            return Redirect::to('/goal/add')
                ->with('flash_message', 'There was a problem adding your goal; please try again.')
                ->withInput();
        }



        return Redirect::to('/goal/add')->with('flash_message', 'Your Goal was successfully added!');
    });

/*//Searching for GOALS

Route::get('/goals_search/{format?}', function($format = 'html')

    {

        $query = Input::get('query');

        if($query)
        {

            $goals = Goal::where('name', 'LIKE', "%query%")->get();

        }

        else {

            $goals = Goal::all();

        }

        if($format == 'json')
        {

            return 'JSON Version';
        }

        elseif ($format == 'pdf') {
            
            return 'PDF Version';
        }

        else {

            return View::make('goals_search')
                    ->with('goals', $goals)
                    ->with('query', $query);
        }
    });
//how to optimize queries!!!!

Route::get('/good-query', function()

{

# 2 queries:
$books = Book::orderBy('id','descending')->get(); # Query on the Database
$first_book = Book::orderBy('id','descending')->first(); # Query on the Database

# 1 query (better):
$books = Book::orderBy('id','descending')->get(); # Query on the Database
$first_book = $books->first(); # Query on the Collection

});


//Below is a COLLECTION object...you can treat it like an array
Route::get('/test', function()

{
$goals = Goal::all();

#This will output a json string
echo $goals;

//this will treat it like an rray

foreach($goals as $goal)

{

	echo $goal['name']."<br>";

	//using object notation below to do same thing above
	echo $goal->name."<br>";
}

});*/

Route::get('/practice-create', function()

{

$goal = new Goal(); //Model or ORM Object

$goal->name = 'Just to Delete';
$goal->description = 'this is a delete test';
$goal->save();

return 'your book has been added';

});


Route::get('/practice-reading', function() {

    # The all() method will fetch all the rows from a Model/table
    $goals = Goal::all();

	$goals = Goal::where('name', 'LIKE', '%maya%')  
	->orWhere('name', 'LIKE', '%p4%')  
	->get(); //when not using all, use get() 

    # Make sure we have results before trying to print them...
    if($goals->isEmpty() != TRUE) {

        # Typically we'd pass $books to a View, but for quick and dirty demonstration, let's just output here...
        foreach($goals as $goal) {
            echo $goal->name.'<br>';
        }
    }
    else {
        return 'No goals found';
    }

});


Route::get('/practice-reading-one-goal', function() {

    $goal = Goal::where('name', 'LIKE', '%p4%')->first();

    if($goal) {
        return $goal->name;
        return $goal->description;
    }
    else {
        return 'Book not found.';
    }

});


Route::get('/practice-updating', function() {

    # First get a book to update
    $goal = Goal::where('name', 'LIKE', '%test%')->first();

    # If we found the book, update it
    if($goal) {

        # Give it a different title
        $goal->name = 'This is an update test';

        # Save the changes
        $goal->save();

        return "Update complete; check the database to see if your update worked...";
    }
    else {
        return "Goal not found, can't update.";
    }

});


Route::get('/practice-deleting', function() {

    # First get a book to delete
    $goal = Goal::where('name', 'LIKE', '%test%')->first();

    # If we found the book, delete it
    if($goal) {

        # Goodbye!
        $goal->delete();

        return "Deletion complete; check the database to see if it worked...";

    }
    else {
        return "Can't delete - Book not found.";
    }

});

Route::get('/practice-deleting-row', function() {

    # First get a book to delete
    $goal = Goal::find(3);

    # If we found the book, delete it
    if($goal) {

        # Goodbye!
        $goal->delete();

        return "Deletion complete; check the database to see if it worked...";

    }
    else {
        return "Can't delete - Goal not found.";
    }

});

Route::get('/', function()
{
	return View::make('index')
	->with('name', 'Sibo');
});

/*Route::get('/signup', function()
{
	return View::make('signup');

});*/

/*Route::get('/login', function()
{
	return View::make('login');

});*/


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
Route::get('/goal/create', 
/*    array(
        'before' => 'guest',*/
        function() {


            return View::make('goal_create');
        }
    );
//);



//Display form for edit a goal
Route::get('goal/edit/{goal}', function($goal)
{


});

//Process form after editing goal
Route::post('goal/edit', function($goal)
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