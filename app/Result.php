<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Result
 *
 * @property-read \Survey\Group $group
 * @property-read \Survey\Questionnaire $questionnaire
 */
class Result extends Model {

    protected $casts = [
        'data' => 'array',
    ];

    public function survey ()
    {
        return $this->belongsTo('Survey\Survey');
    }

}
