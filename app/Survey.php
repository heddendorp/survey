<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model {

	public function answers()
    {
        return $this->hasMany('Survey\Answer');
    }

    public function tokens()
    {
        return $this->hasMany('Survey\Token');
    }

    public function result()
    {
        return $this->hasMany('Survey\Result');
    }

}
