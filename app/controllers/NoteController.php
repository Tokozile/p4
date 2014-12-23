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


	public function getAdd() {

		return View::make('notes_add');

	}

	/**
	* Process the "Edit a book form"
	* @return Redirect
	*/
	public function postAdd() {

			$data = Input::all();
		# Step 1) Define the rules
		$rules = array(
			'note' => 'required',
			'goals_users_id' => 'required|numeric'
		);

		# Step 2)
		$validator = Validator::make($data, $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/note/add')
				->with('flash_message', 'There seems to have been a problem adding your note. Please note that all fields are required.')
				->withInput()
				->withErrors($validator);
		}

		if($validator->passes()) {

	        #Instantiate the goal model

			$note = new Note();
	        $note->note = Input::get('note');
	        $note->goals_users_id = Input::get('goals_users_id');

			$note->save();

			try {
		            $note->save();

		            return Redirect::to('/note/add')->with('flash_message', 'Your Note was successfully added!');
		        }
		        catch (Exception $e) {
		            return Redirect::to('/note/add')
		                ->with('flash_message', 'There was a problem adding your note; please try again.')
		                ->withInput();
		        }
        }
	}

	public function getIndex() {

			 #find current user id
		    $currentUser = Auth::id();

		    #get all goals whose users_id matched the current user's id
		   $notes = DB::table('notes')->where('goals_users_id', '=', $currentUser)->get();
		   //return $test2;
		   $noteOutput = '';
		   #return the name and description of each goal for this user  #THIS WORKS
		   foreach ($notes as $note) 
		            {

		            	$noteOutput .= View::make('notes_results')->with('note', $note)->render();

		            }

		            if ($noteOutput ) {
		            	
		            	return $noteOutput;
		            }

		            else {

		          		return Redirect::intended('/')->with('flash_message','Sorry, we did not find any notes for you');
		            }
	}

	public function getSearch() {

		return View::make('note_search');

	}

	public function postSearch() {

			$query  = Input::get('query');

			 #find current user id
		    $currentUser = Auth::id();

		    #get all goals whose users_id matched the current user's id
		   $notes = DB::table('notes')->where('goals_users_id', '=', $currentUser)
		   ->where('note', 'LIKE', "%$query%")
		   ->get();
		   //return $test2;
		   $noteOutput = '';
		   #return the name and description of each goal for this user
		   foreach ($notes as $note) 
		            {
		 		            	
		            		$noteOutput .= View::make('notes_results')->with('note', $note)->render();

		            }

		            if ($noteOutput)
		            {
		            	return $noteOutput; 

		            }

		            else {
		            
	   				return Redirect::intended('/note/search')->with('flash_message','Sorry, no notes were found with that input. Please try again');

		            }
		            return $noteOutput; 
	}


	public function getEdit($id) {


 		$notes = DB::table('notes')->where('id', '=', $id)
		   ->get();
			            
		   				$noteOutput = '';
		   			#return the name and description of each goal for this user
		   			foreach ($notes as $note) 
		            {

		            		$noteOutput .= View::make('note_edit')->with('note', $note)->render();
		            }

		            return $noteOutput; 
		
	}


	/**
	* Process the "Edit a book form"
	* @return Redirect
	*/
	public function postEdit() {

				// Fetch all request data.
    	$data = Input::all();

    	// Build the validation constraint set.
    	$rules = array(
  			'note' => 'required',
    	);

    	// Create a new validator instance.
    	$validator = Validator::make($data, $rules);

    	if($validator->fails()) {

			return Redirect::action('NoteController@getIndex')
				->with('flash_message', 'There seems to have been a problem editing your note. Please note that all fields are required.')
				->withInput()
				->withErrors($validator);
		}

    	if ($validator->passes()) {

    	}

			try {
		        $note = Note::findOrFail(Input::get('id'));
		    }
		    catch(exception $e) {
		        return Redirect::to('/profile')->with('flash_message', 'Note not found');
		    }

		    # http://laravel.com/docs/4.2/eloquent#mass-assignment
		    #add goal values and save
		    $note->fill(Input::all());
		    $note->save();

		    
		   	return Redirect::action('NoteController@getIndex')->with('flash_message','Your changes have been saved.');
	}

	public function postDelete() {

		try {
	        $note = Note::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	   	return Redirect::action('NoteController@getIndex')->with('flash_message','This Note could not be deleted');
	    }

	    Note::destroy(Input::get('id'));

	   	return Redirect::action('NoteController@getIndex')->with('flash_message','Your Note has been deleted.');

	}
	

	
}	            

