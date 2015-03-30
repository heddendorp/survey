<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:45
 */

namespace Survey\Models;


use Illuminate\Database\Eloquent\Model;

class Child extends Model {

    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'children';

    protected $fillable = ['name', 'email'];

    public function group ()
    {
        return $this->belongsTo('Survey\Group');
    }

}