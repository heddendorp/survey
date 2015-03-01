<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Answer
 *
 * @property-read \Survey\Question $question
 * @property-read \Survey\Child $child
 */
class Answer extends Model {

    public function survey ()
    {
        return $this->belongsTo('Survey\Survey');
    }

    public function result ()
    {
        return $this->belongsTo('Survey\Result');
    }

}
