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

$goal->name = 'test3';
$goal->description = 'this is a another test';
$goal->users_id = 1;
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

Route::get('/practice-reading2', function() {

    # The all() method will fetch all the rows from a Model/table
    //$goals = Goal::all();
/*    $users = User::all();

    $goals = Goal::where('name', 'LIKE', '%test%')  
    ->orWhere('users_id', 'LIKE', '%2%')  
    ->get(); //when not using all, use get() */
$userID = Auth::id();
  //return $userID;

    $goals = DB::table('goals')
    ->get();
//return $goals;
   
/*foreach ($goals as $goal) {
    
    if ($goal->id == $userID) {
        echo $goal->name.'<br>';

    }
 

    else{
        return 'No Goal was Found';
    }*/

        for($i = 0; $i < count($goals); ++$i) {

                //if ($goals->id == $userID) {
                    
                    echo $goals[$i]['id'];
                }


            /*foreach ($goals as $goal) {
    
                if ($goal->id == $userID) {
                    echo $goal->name.'<br>';
                }
            
        
                else{
                    return 'No Goal was Found';
                }*/
            
        //}
  
 /* if ($users->id == $goals->id) {
               
               echo $goals->name.'<br>';
           }

           else {

            return 'No Goals Found';
           }*/

/*    foreach ($users as $user) {
        
        foreach ($goals as $goal) {
           if ($user->id == $goal->id) {
               
               echo $goal->name.'<br>';
           }

           else {

            return 'No Goals Found';
           }
        }
    }*/


#foreach ($goals as $goal) {
#            return $goal->id;
#        }

/*        $goals = DB::table('users')

        ->Join('goals', Auth::user()->id, '=', 'goals.users.id')
        ->get();
*/
        //look at goals table and show only goals where the users.id = users.name

    # Make sure we have results before trying to print them...
#    if($goals) {

        # Typically we'd pass $goal to a View, but for quick and dirty demonstration, let's just output here...
#        foreach($goals as $goal) {
#            echo $goal->name.'<br>';
            //echo $goal->first_name.'<br>';
#       }
#    }
#    else {
#        return 'No goals found';
#    }

});


Route::get('/practice-reading3', function() {

    #find current user id
    $currentUser = Auth::id();

    #get all goals whose users_id matched the current user's id
   $goals = DB::table('goals')->where('users_id', '=', $currentUser)->get();
   //return $test2;
 $goalOutput = '';
   #return the name and description of each goal for this user
   foreach ($goals as $goal) 
            {

            $goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();

          
               #echo $goal->name.': ';
               #echo $goal->description.'<br>';
            }

            return $goalOutput;
    

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