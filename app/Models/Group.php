<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:40.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Group
 *
 * @property integer $id 
 * @property integer $facility_id 
 * @property integer $type 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Survey\Facility $facility 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Child[] $children 
 * @property-read mixed $stringtype 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Group whereFacilityId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Group whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Group whereUpdatedAt($value)
 */
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
