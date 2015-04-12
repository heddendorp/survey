<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:36.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Facility.
 *
 * @property integer $id
 * @property integer $set_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Models\Set $set
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Group[] $groups
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Facility whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Facility whereSetId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Facility whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Facility whereUpdatedAt($value)
 */
class Facility extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'facilities';

    protected $fillable = ['name'];

    public function set()
    {
        return $this->belongsTo('Survey\Models\Set');
    }

    public function groups()
    {
        return $this->hasMany('Survey\Models\Group');
    }
}
