<?php

class GoalController extends \BaseController {

/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

		$this->beforeFilter('auth', array('except' => ['getIndex']));
	}

	public function getIndex() {


			 #find current user id
		    $currentUser = Auth::id();

		    #get all goals whose users_id matched the current user's id
		   $goals = DB::table('goals')->where('users_id', '=', $currentUser)->get();
		   //return $test2;
		   $goalOutput = '';
		   #return the name and description of each goal for this user  #THIS WORKS
		   foreach ($goals as $goal) 
		            {

		            	$goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();

		            }

		            if ($goalOutput ) {
		            	
		            	return $goalOutput;
		            }

		            else {

		          		return Redirect::intended('/')->with('flash_message','Sorry, we did not find any goals for you but you can always create new goals. Good Luck!');
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
		   ->where('name', 'LIKE', "%$query%")
		   ->orWhere('description', 'LIKE', "%$query%")
		   ->get();
		   //return $test2;
		   $goalOutput = '';
		   #return the name and description of each goal for this user
		   foreach ($goals as $goal) 
		            {
		 		            	
		            		$goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();

		            }

		            if ($goalOutput)
		            {
		            	return $goalOutput; 

		            }

		            else {
		            
	   				return Redirect::intended('/goal/search')->with('flash_message','Sorry, no goals were found with that input. Please try again');

		            }
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
	* Process the "Edit a goal form"
	* @return Redirect
	*/
	public function postEdit() {

/*

				# Step 1) Define the rules
		$rules = array(
			'name' => 'required_without_all',
			'description' => 'required',
			'users_id' => 'required|numeric',
			'created_at' => 'required if|date',
			'updated_at' => 'required if|date',
			
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::action('GoalController@getIndex')
				->with('flash_message', 'There seems to have been a problem editing your goal. Please note that all fields are required.')
				->withInput()
				->withErrors($validator);
		}*/


		try {
	        $goal = Goal::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/profile')->with('flash_message', 'Goal not found');
	    }

	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    #add goal values and save
	    $goal->fill(Input::all());
	    $goal->save();

	    
	   	return Redirect::action('GoalController@getIndex')->with('flash_message','Your changes have been saved.');

	}

	public function getAdd() {

        return View::make('goal_add');
    }

    /**
    * 
    * @return Redirect
    */

	public function postAdd() {

		# Step 1) Define the rules
		$rules = array(
			'name' => 'required',
			'description' => 'required',
			'users_id' => 'required|numeric'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/goal/add')
				->with('flash_message', 'There seems to have been a problem adding your goal. Please note that all fields are required.')
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

			            $goalOutput .= View::make('goal_search_results')->with('goal', $goal)->render();

			            }

			            if ($goalOutput) {
			            	
			            return $goalOutput;
			            }

			            else {

			          return Redirect::intended('/')->with('flash_message','You have no completed goals yet but keep at it and Good Luck!');
			            }
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

			            if ($goalOutput) {
			            	
			            return $goalOutput;
			            }

			            else {

			          return Redirect::intended('/')->with('flash_message','It appears we have no goals for you yet. Please create some.');
			            }

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


	   	return Redirect::action('GoalController@getIndex')->with('flash_message','Congratulations on completing your goal!');

	}
	
}	            

