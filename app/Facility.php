<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Facility
 *
 * @property-read \Survey\Iteration $iteration
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Group[] $groups
 */
class Facility extends Model {

	public function iteration ()
    {
        return $this->belongsTo('Survey\Iteration');
    }

    public function groups ()
    {
        return $this->hasMany('Survey\Group');
    }

}
