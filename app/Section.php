<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Section
 *
 * @property-read \Survey\Questionnaire $questionnaire
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Questiongroup[] $questiongroup
 * @property integer $id 
 * @property integer $questionnaire_id 
 * @property string $title 
 * @property string $intern 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Questiongroup[] $questiongroups 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Section whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Section whereQuestionnaireId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Section whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Section whereIntern($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Section whereUpdatedAt($value)
 */
class Section extends Model {

	public function questionnaire ()
    {
        return $this->belongsTo('Survey\Questionnaire');
    }

    public function questiongroups ()
    {
        return $this->hasMany('Survey\Questiongroup');
    }

}
