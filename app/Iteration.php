<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Iteration
 *
 * @property-read \App/Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Facility[] $facilities
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
