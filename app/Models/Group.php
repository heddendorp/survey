<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:40.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'groups';

    protected $fillable = ['name', 'type'];

    public function facility()
    {
        return $this->belongsTo('Survey\Facility');
    }

    public function children()
    {
        return $this->hasMany('Survey\Child');
    }

    public function getStringtypeAttribute()
    {
        switch ($this->type) {
            case 1:
                return 'Kindergarten';
            case 2:
                return 'Kinderkrippe';
            default:
                return 'Es ist ein Fehler aufgetreten';
        }
    }
}
