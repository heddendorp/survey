<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Iteration[] $iterations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Questionnaire[] $questionnaires
 */
class Customer extends Model {

	public function iterations ()
    {
        return $this->hasMany('Survey\Iteration');
    }

    public function users ()
    {
        return $this->hasMany('Survey\User');
    }

    public function questionnaires ()
    {
        return $this->hasMany('Survey\Questionnaire');
    }

}
