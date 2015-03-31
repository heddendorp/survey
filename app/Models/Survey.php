<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 13:03.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $dates = ['created_at', 'updated_at', 'ends'];

    protected $table = 'surveys';

    protected $fillable = ['name', 'welcome_mail', 'remember_mail', 'finish_mail', 'ends'];

    protected $casts = [
        'questions' => 'array',
        'groups' => 'array',
    ];

    public function answers()
    {
        return $this->hasMany('Survey\Models\Answer');
    }

    public function keys()
    {
        return $this->hasManyThrough('Survey\Models\Key', 'Survey\Models\Result');
    }

    public function results()
    {
        return $this->hasMany('Survey\Models\Result');
    }

    public function customer()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }
}
