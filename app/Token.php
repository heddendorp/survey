<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Token.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Mail[] $mails
 * @property-read \Survey\Questionnaire $questionnaire
 * @property-read \Survey\Child $child
 * @property integer $id
 * @property integer $facility
 * @property integer $group
 * @property integer $survey_id
 * @property integer $result_id
 * @property integer $progress
 * @property string $name
 * @property string $email
 * @property string $token
 * @property boolean $finished
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Survey $survey
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereFacility($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereSurveyId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereResultId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereProgress($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereFinished($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Token whereUpdatedAt($value)
 */
class Token extends Model
{
    protected $casts = [
        'child' => 'array',
    ];

    public function mails()
    {
        return $this->hasMany('Survey\Mail');
    }

    public function survey()
    {
        return $this->belongsTo('Survey\Survey');
    }

    public function answers()
    {
        return $this->hasMany('Survey\Answer');
    }

    public function result()
    {
        return $this->belongsTo('Survey\Result');
    }
}
