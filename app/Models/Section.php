<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 09:03.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Section.
 *
 * @property integer $id
 * @property integer $questionnaire_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Models\Questionnaire $questionnaire
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Batch[] $batches
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Section whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Section whereQuestionnaireId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Section whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Section whereUpdatedAt($value)
 */
class Section extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'sections';

    protected $fillable = ['name'];

    public function questionnaire()
    {
        return $this->belongsTo('Survey\Models\Questionnaire');
    }

    public function batches()
    {
        return $this->hasMany('Survey\Models\Batch');
    }
}
