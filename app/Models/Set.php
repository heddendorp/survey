<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:33
 */

namespace Survey\Models;


use Illuminate\Database\Eloquent\Model;

class Set extends Model {

    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'sets';

    protected $fillable = ['name'];

    public function customer ()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }

    public function facilities ()
    {
        return $this->hasMany('Survey\Models\Facility');
    }

}