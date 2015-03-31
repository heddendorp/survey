<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 31.03.2015
 * Time: 23:39.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'results';

    public function survey()
    {
        return $this->belongsTo('Survey\Models\Survey');
    }

    public function keys()
    {
        return $this->hasMany('Survey\Models\Key');
    }

    public function answers()
    {
        return $this->hasManyThrough('Survey\Models\Answer', 'Survey\Models\Key');
    }
}
