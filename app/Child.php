<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Child
 *
 * @property-read \Survey\Group $group 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Token[] $tokens 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Answer[] $answers 
 */
class Child extends Model {

	public function group ()
    {
        return $this->belongsTo('Survey\Group');
    }

    public function tokens ()
    {
        return $this->hasMany('Survey\Token');
    }

    public function answers ()
    {
        return $this->hasMany('Survey\Answer');
    }

}
