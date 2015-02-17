<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Questiongroup
 *
 * @property-read \Survey\Section $section 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Question[] $questions 
 */
class Questiongroup extends Model {

	public function section ()
    {
        return $this->belongsTo('Survey\Section');
    }

    public function questions ()
    {
        return $this->hasMany('Survey\Question');
    }

}
