<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Questionnaire.
 *
 * @property-read \Survey\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Token[] $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Result[] $results
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Section[] $sections
 * @property integer $id
 * @property integer $customer_id
 * @property string $title
 * @property string $intern
 * @property string $welcome_mail
 * @property string $remember_mail
 * @property string $finish_mail
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereIntern($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereWelcomeMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereRememberMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereFinishMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Questionnaire whereUpdatedAt($value)
 */
class Questionnaire extends Model
{
    public function customer()
    {
        return $this->belongsTo('Survey\Customer');
    }

    public function sections()
    {
        return $this->hasMany('Survey\Section');
    }
}
