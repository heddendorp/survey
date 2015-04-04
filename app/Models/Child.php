<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:45.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Child.
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Group $group
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Child whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Child whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Child whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Child whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Child whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Child whereUpdatedAt($value)
 */
class Child extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'children';

    protected $fillable = ['name', 'email'];

    public function group()
    {
        return $this->belongsTo('Survey\Group');
    }
}
