<?php

class Library {


	public function search($query) {

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

		return $results;
	}


}

