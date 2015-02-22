<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model {

    protected $casts = [
        'members' => 'array',
        'groups' => 'array',
        'questions' => 'array',
        'facilities' => 'array',
    ];

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

    public function customer()
    {
        return $this->belongsTo('Survey\Customer');
    }

}
