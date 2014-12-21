<?php

class Library {

	//Properties (Variables)

	/*//Array*/
	#public $goals;


	//String
	/*public $path;

	//Methods (Functions)
	public function SetPath($path)
	{

	$this->path = $path;

	}

	public function getPath()
	{

	return $this->path;
	} */

	/*public function getGoals() {

		// Get the file
    	$goals = DB::table('goals')->get();

    	// Convert to an array
    	$this->goals = json_decode($goals,true);

    	return $this->goals;
	}*/

	/*public function search($query) {

		# If any goals match our query, they'll get stored in this array
		$results = Array();

		# Loop through the goals looking for matches
		foreach($this->goals as $name => $goal) {
					
			# First compare the query against the name
			if(stristr($name,$query)) {
			
				# There's a match - add this goal the the $results array
				$results[$name] = $goal;
			}
			# Then compare the query against all the attributes of the goal (user & notes)
			else {
						
				if(self::search_goal_attributes($goal,$query)) {
					# There's a match - add this goal to the the $results array
					$results[$name] = $goal;
				}
			}
		}

		return $results;*/

/*	}

	private function search_goal_attributes($attributes,$query) { 
	    
		foreach($attributes as $k => $value) { 
		    
		  	# Dig deeper
		    if (is_array($value)) {
		    	return self::search_book_attributes($value,$query);
		    }
				
				if(stristr($value,$query)) {
					return true;
				}             
		} 

		return false;

	}*/


}

