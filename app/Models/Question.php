<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 12:55.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'questions';

    protected $fillable = ['content'];

    public function batch()
    {
        return $this->belongsTo('Survey\Models\Batch');
    }
}
