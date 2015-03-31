<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:05.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'customers';

    protected $fillable = ['name', 'info_email', 'logo'];

    public function sets()
    {
        return $this->hasMany('Survey\Models\Set');
    }

    public function users()
    {
        return $this->hasMany('Survey\Models\User');
    }

    public function questionnaires()
    {
        return $this->hasMany('Survey\Models\Questionnaire');
    }

    public function surveys()
    {
        return $this->hasMany('Survey\Models\Survey');
    }
}
