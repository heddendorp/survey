<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 31.03.2015
 * Time: 23:39.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Result.
 *
 * @property integer $id
 * @property integer $survey_id
 * @property integer $group
 * @property string $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Models\Survey $survey
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Key[] $keys
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Result whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Result whereSurveyId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Result whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Result whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Result whereUpdatedAt($value)
 */
class Result extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'results';

    public function survey()
    {
        return $this->belongsTo('Survey\Models\Survey');
    }

    public function keys()
    {
        return $this->hasMany('Survey\Models\Key');
    }

    public function answers()
    {
        return $this->hasManyThrough('Survey\Models\Answer', 'Survey\Models\Key');
    }
}
