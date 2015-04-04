<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:33.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Set
 *
 * @property integer $id 
 * @property integer $customer_id 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Survey\Models\Customer $customer 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Facility[] $facilities 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Set whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Set whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Set whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Set whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Set whereUpdatedAt($value)
 */
class Set extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'sets';

    protected $fillable = ['name'];

    public function customer()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }

    public function facilities()
    {
        return $this->hasMany('Survey\Models\Facility');
    }
}
