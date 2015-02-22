<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Token
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Mail[] $mails
 * @property-read \Survey\Questionnaire $questionnaire
 * @property-read \Survey\Child $child
 */
class Token extends Model {

    protected $casts = [
        'child' => 'array',
    ];

	public function mails ()
    {
        return $this->hasMany('Survey\Mail');
    }

    public function survey ()
    {
        return $this->belongsTo('Survey\Survey');
    }

}
