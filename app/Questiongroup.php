<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Questiongroup.
 *
 * @property-read \Survey\Section $section
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Question[] $questions
 * @property integer $id
 * @property integer $section_id
 * @property integer $type
 * @property integer $order
 * @property integer $condition
 * @property string $heading
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereSectionId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereCondition($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereHeading($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questiongroup whereUpdatedAt($value)
 */
class Questiongroup extends Model
{
    public function section()
    {
        return $this->belongsTo('Survey\Section');
    }

    public function questions()
    {
        return $this->hasMany('Survey\Question');
    }

    public function stringType()
    {
        switch ($this->type) {
            case 1:
                return 'Textfrage';
            case 2:
                return 'Auswahlfrage';
            case 3:
                return '5er-Frage';
            case 4:
                return '10er-Frage';
            default:
                return 'Es ist ein Fehler aufgetreten';
        }
    }

    public function stringCondition()
    {
        switch ($this->condition) {
            case 1:
                return 'für alle Teilnehmer';
            case 2:
                return 'für Krippenteilnehmer';
            case 3:
                return 'für Kindergartenteilnehmer';
            default:
                return 'Es ist ein Fehler aufgetreten';
        }
    }
}
