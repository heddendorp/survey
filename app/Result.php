<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Result
 *
 * @property-read \Survey\Group $group
 * @property-read \Survey\Questionnaire $questionnaire
 */
class Result extends Model {

	public function group ()
    {
        return $this->belongsTo('Survey\Group');
    }

    public function questionnaire ()
    {
        return $this->belongsTo('Survey\Questionnaire');
    }

}
