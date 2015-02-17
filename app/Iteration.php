<?php namespace survey;

use Illuminate\Database\Eloquent\Model;

/**
 * survey\Iteration
 *
 * @property-read \App/Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Facility[] $facilities 
 */
class Iteration extends Model {

	public function customer ()
    {
        return $this->belongsTo('App/Customer');
    }

    public function facilities ()
    {
        return $this->hasMany('App/Facility');
    }

}
