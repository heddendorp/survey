<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Section
 *
 * @property-read \Survey\Questionnaire $questionnaire 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Questiongroup[] $questiongroup 
 */
class Section extends Model {

	public function questionnaire ()
    {
        return $this->belongsTo('Survey\Questionnaire');
    }

    public function questiongroup ()
    {
        return $this->hasMany('Survey\Questiongroup');
    }

}
