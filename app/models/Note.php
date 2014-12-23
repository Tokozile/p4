<?php

class Note extends Eloquent {


    # The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'updated_at', 'goals_users_id');

  /*  *
    * Goal belongs to User
    * Define an inverse one-to-many relationship. */
    
	public function user() {

        return $this->belongsTo('User');

    }

    
    /* Notes Belong to Goal*/
    
    /*public function goals() {

        return $this->belongsTo('Goal');

    }*/

    /**
    * Search among goals and notes
    * @return Collection
    */


	
}
