<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 09:03
 */

namespace Survey\Models;


use Illuminate\Database\Eloquent\Model;

class Section extends Model {

    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'sections';

    protected $fillable = ['name'];

    public function questionnaire ()
    {
        return $this->belongsTo('Survey\Models\Questionnaire');
    }

    public function batches ()
    {
        return $this->hasMany('Survey\Models\Batch');
    }

}