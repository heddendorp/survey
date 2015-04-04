<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:05.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Customer
 *
 * @property integer $id 
 * @property string $name 
 * @property string $logo 
 * @property string $info_email 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Set[] $sets 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\User[] $users 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Questionnaire[] $questionnaires 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Survey[] $surveys 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Customer whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Customer whereInfoEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Customer whereUpdatedAt($value)
 */
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
