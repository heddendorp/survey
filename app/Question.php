<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Question
 *
 * @property-read \Survey\Questiongroup $questiongroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Answer[] $answers
 */
class Question extends Model {

	public function questiongroup ()
    {
        return $this->belongsTo('Survey\Questiongroup');
    }

    public function answers ()
    {
        return $this->hasMany('Survey\Answer');
    }

}
