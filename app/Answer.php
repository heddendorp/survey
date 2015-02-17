<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Answer
 *
 * @property-read \Survey\Question $question 
 * @property-read \Survey\Child $child 
 */
class Answer extends Model {

	public function question ()
    {
        return $this->belongsTo('Survey\Question');
    }

    public function child ()
    {
        return $this->belongsTo('Survey\Child');
    }

}
