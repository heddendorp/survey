<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 31.03.2015
 * Time: 23:24
 * TODO map the new database and relation structure.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'answers';

    protected $fillable = ['answer', 'question'];

    public function key()
    {
        return $this->belongsTo('Survey\Models\Key');
    }
}
