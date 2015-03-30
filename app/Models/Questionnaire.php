<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 09:00
 */

namespace Survey\Models;


use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model {

    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'questionnaires';

    protected $fillable = ['name',];

    public function customer ()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }

    public function sections ()
    {
        return $this->hasMany('Survey\Models\Section');
    }

}