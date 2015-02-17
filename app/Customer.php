<?php namespace survey;

use Illuminate\Database\Eloquent\Model;

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
