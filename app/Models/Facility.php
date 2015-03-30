<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:36
 */

namespace Survey\Models;


class Facility {

    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'facilities';

    protected $fillable = ['name'];

    public function set ()
    {
        return $this->belongsTo('Survey\Models\Set');
    }

    public function groups ()
    {
        return $this->hasMany('Survey\Models\Group');
    }

}