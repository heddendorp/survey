<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Group.
 *
 * @property-read \Survey\Facility $facility
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Child[] $children
 * @property integer $id
 * @property integer $facility_id
 * @property integer $type
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Group whereFacilityId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Group whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Group whereUpdatedAt($value)
 */
class Group extends Model
{
    public function facility()
    {
        return $this->belongsTo('Survey\Facility');
    }

    public function children()
    {
        return $this->hasMany('Survey\Child');
    }

    public function stringType()
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
