<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Questionnaire
 *
 * @property-read \Survey\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Token[] $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Result[] $results
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Section[] $sections
 */
class Questionnaire extends Model {

    public function customer ()
    {
        return $this->belongsTo('Survey\Customer');
    }

    public function sections ()
    {
        return $this->hasMany('Survey\Section');
    }

}
