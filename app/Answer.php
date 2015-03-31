<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

//TODO remove all old Models

/**
 * Survey\Answer.
 *
 * @property-read \Survey\Question $question
 * @property-read \Survey\Child $child
 * @property integer $id
 * @property integer $survey_id
 * @property integer $token_id
 * @property integer $result_id
 * @property integer $answer
 * @property integer $type
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Survey $survey
 * @property-read \Survey\Result $result
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereSurveyId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereTokenId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereResultId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Answer whereUpdatedAt($value)
 */
class Answer extends Model
{
    public function survey()
    {
        return $this->belongsTo('Survey\Survey');
    }

    public function result()
    {
        return $this->belongsTo('Survey\Result');
    }
}
