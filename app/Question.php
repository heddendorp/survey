<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Question.
 *
 * @property-read \Survey\Questiongroup $questiongroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Answer[] $answers
 * @property integer $id
 * @property integer $questiongroup_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Question whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Question whereQuestiongroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Question whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Question whereUpdatedAt($value)
 */
class Question extends Model
{
    public function questiongroup()
    {
        return $this->belongsTo('Survey\Questiongroup');
    }

    public function answers()
    {
        return $this->hasMany('Survey\Answer');
    }
}
