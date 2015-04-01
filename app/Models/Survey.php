<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 13:03.
 */

namespace Survey\Models;

use Carbon\Carbon;
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

    public function getOpenAttribute()
    {
        $now = Carbon::now();
        if(!isset($this->ends))
        {
            return true;
        } else {
            return ($this->ends->diff($now)->days == 0);
        }
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
