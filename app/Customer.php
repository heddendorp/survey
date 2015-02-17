<?php namespace survey;

use Illuminate\Database\Eloquent\Model;

/**
 * survey\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Iteration[] $iterations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Questionnaire[] $questionnaires
 */
class Customer extends Model {

	public function iterations ()
    {
        return $this->hasMany('App/Iteration');
    }

    public function users ()
    {
        return $this->hasMany('App/User');
    }

    public function questionnaires ()
    {
        return $this->hasMany('App/Questionnaire');
    }

}
