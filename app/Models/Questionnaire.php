<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 09:00.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Questionnaire
 *
 * @property integer $id 
 * @property integer $customer_id 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Survey\Models\Customer $customer 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Section[] $sections 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Questionnaire whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Questionnaire whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Questionnaire whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Questionnaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Questionnaire whereUpdatedAt($value)
 */
class Questionnaire extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'questionnaires';

    protected $fillable = ['name'];

    public function customer()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }

    public function sections()
    {
        return $this->hasMany('Survey\Models\Section');
    }
}
