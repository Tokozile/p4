<?php

class NoteController extends \BaseController {

/**
	*
	*/

		public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

		$this->beforeFilter('auth', array('except' => ['getIndex']));

	}


	public function getAdd($id) {

		            		return View::make('notes_add');

	}


	/**
	* Process the "Edit a book form"
	* @return Redirect
	*/
	public function postAdd() {

		try {
	        $goal = Goal::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/profile')->with('flash_message', 'Goal not found');
	    }

	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    $goal->fill(Input::all());
	    $goal->save();


	   	return Redirect::action('GoalController@getIndex')->with('flash_message','Your changes have been saved.');

	}







	public function getIndex() {


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
	}

	public function getAdd() {

        return View::make('goal_add');
    }


    /**
    * Process the "Add a book form"
    * @return Redirect
    */


	public function postAdd() {

		# Step 1) Define the rules
		$rules = array(
			'name' => 'required',
			'description' => 'required',
			'users_id' => 'required'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/goal_add')
				->with('flash_message', 'There seems to have been a problem adding your goal. Please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

        #Instantiate the goal model
        $goal = new Goal();
        $goal->name = Input::get('name');
        $goal->description = Input::get('description');
        $goal->users_id = Input::get('users_id');
        try {
            $goal->save();
            return Redirect::to('/goal/add')->with('flash_message', 'Your Goal was successfully added!');
        }
        catch (Exception $e) {
            return Redirect::to('/goal/add')
                ->with('flash_message', 'There was a problem adding your goal; please try again.')
                ->withInput();
        }
	}


	public function getSearch() {

		return View::make('goal_search');

	}




	public function postSearch() {

		

			$query  = Input::get('query');


			 #find current user id
		    $currentUser = Auth::id();

		    #get all goals whose users_id matched the current user's id
		   $goals = DB::table('goals')->where('users_id', '=', $currentUser)
		   ->where('name', '=', $query)
		   ->get();
		   //return $test2;
		   $goalOutput = '';
		   #return the name and description of each goal for this user
		   foreach ($goals as $goal) 
		            {
		            	if ($goal) {
		            	
		            		$goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();
		            	}

		            	else{

		            		return View::make('general')->with('flash_message', 'You do not have any goals created yet. Please Click on the link below to start creating goals!');

		            	}

		            }

		            return $goalOutput; 
	}


	public function getEdit($id) {


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
	}


	/**
	* Process the "Edit a book form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $goal = Goal::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/profile')->with('flash_message', 'Goal not found');
	    }

	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    $goal->fill(Input::all());
	    $goal->save();


	   	return Redirect::action('GoalController@getIndex')->with('flash_message','Your changes have been saved.');

	}

		public function getComplete() {

		   #get all goals whose users_id matched the current user's id*/

									 #find current user id
					    $currentUser = Auth::id();

					    #get all goals whose users_id matched the current user's id
					   $goals = DB::table('goals')->where('users_id', '=', $currentUser)
					 	->where('goal_completed', '=', '1')
					 	->get();
					   $goalOutput = '';
					   #return the name and description of each goal for this user
					   foreach ($goals as $goal) 
					            {
					            	if ($goal) {
					            	
					            		$goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();
					            	
					            	}

					            	elseif (! $goal->isEmpty()) {
					            			return View::make('general')->with('flash_message','You Have no complted goals')->render();
					            		
					            	}
					            }

					            return $goalOutput;

	   		#return Redirect::action('GoalController@getIndex')->with('flash_message','The following Goals have NOT been Completed.');
	   	}


		public function getIncomplete() {

					 #find current user id
		    $currentUser = Auth::id();

		    #get all goals whose users_id matched the current user's id
		   $goals = DB::table('goals')->where('users_id', '=', $currentUser)
		 	->where('goal_completed', '=', '0')
		 	->get();
		   $goalOutput = '';
		   #return the name and description of each goal for this user
		   foreach ($goals as $goal) 
		            {

		            $goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();

		            }

		            return $goalOutput;

	   		#return Redirect::action('GoalController@getIndex')->with('flash_message','The following Goals have been Completed.');

		}

		public function postDelete() {

		try {
	        $goal = Goal::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	   	return Redirect::action('GoalController@getIndex')->with('flash_message','This Goal could not be deleted');
	    }

	    Goal::destroy(Input::get('id'));

	   	return Redirect::action('GoalController@getIndex')->with('flash_message','Your Goal has been deleted.');

	}


	public function postComplete() {

		try {
	        $goal = Goal::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	   	return Redirect::action('GoalController@getIndex')->with('flash_message','This Goal could not be completed');
	    }

	     $goal->goal_completed = '1';

					        # Save the changes
					        $goal->save();


	   	return Redirect::action('GoalController@getIndex')->with('flash_message','Your Goal has been complete.');

	}
	
}	            

