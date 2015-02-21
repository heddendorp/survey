<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Result
 *
 * @property-read \Survey\Group $group
 * @property-read \Survey\Questionnaire $questionnaire
 */
class Result extends Model {

    public function survey ()
    {
        return $this->belongsTo('Survey\Survey');
    }

}
