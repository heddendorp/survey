<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 13:11
 */

namespace Survey\Models;


use Illuminate\Database\Eloquent\Model;

class Key extends Model {

    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'keays';

    public function mails ()
    {
        return $this->hasMany('Survey\Models\Mail');
    }

    public function answers()
    {
        return $this->hasMany('Survey\Models\Answer');
    }

    public function result ()
    {
        return $this->belongsTo('Survey\Models\Result');
    }

}