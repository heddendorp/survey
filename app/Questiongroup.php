<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Questiongroup
 *
 * @property-read \Survey\Section $section
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Question[] $questions
 */
class Questiongroup extends Model {

	public function section ()
    {
        return $this->belongsTo('Survey\Section');
    }

    public function questions ()
    {
        return $this->hasMany('Survey\Question');
    }

    public function stringType ()
    {
        switch ($this->type)
        {
            case 1:
                return 'Textfrage';
            case 2:
                return 'Auswahlfrage';
            case 3:
                return '5er-Frage';
            case 4:
                return '10er-Frage';
        }
    }

    public function stringCondition ()
    {
        switch ($this->condition)
        {
            case 1:
                return 'für alle Teilnehmer';
            case 2:
                return 'für Teilnehmer mit Kind in der Krippe';
            case 3:
                return 'Für Teilnehmer mit Kind im Kindergarten';
        }
    }

}
