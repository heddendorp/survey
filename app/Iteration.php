<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Iteration
 *
 * @property-read \App/Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Facility[] $facilities
 * @property integer $id 
 * @property integer $customer_id 
 * @property string $description 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Iteration whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Iteration whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Iteration whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Iteration whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Iteration whereUpdatedAt($value)
 */
class Iteration extends Model {

	public function customer ()
    {
        return $this->belongsTo('Survey\Customer');
    }

    public function facilities ()
    {
        return $this->hasMany('Survey\Facility');
    }

}
