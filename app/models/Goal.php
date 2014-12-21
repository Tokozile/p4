<?php

class Goal extends Eloquent {


    # The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'updated_at');

  /*  *
    * Goal belongs to User
    * Define an inverse one-to-many relationship. */
    
	public function user() {

        return $this->belongsTo('User');

    }

    
    /* Notes Belong to Goal*/
    
    public function notes() {

        return $this->belongsTo('Note');

    }

    /**
    * Search among goals and notes
    * @return Collection
    */


	
}