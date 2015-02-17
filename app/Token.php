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

	public function mails ()
    {
        return $this->hasMany('Survey\Mail');
    }

    public function questionnaire ()
    {
        return $this->belongsTo('Survey\Questionnaire');
    }

    public function child ()
    {
        return $this->belongsTo('Survey\Child');
    }

}
