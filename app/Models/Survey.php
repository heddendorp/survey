<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 13:03.
 */

namespace Survey\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Survey.
 *
 * @property integer $id
 * @property integer $customer_id
 * @property boolean $started
 * @property string $questions
 * @property string $groups
 * @property string $welcome_mail
 * @property string $remember_mail
 * @property string $finish_mail
 * @property string $name
 * @property \Carbon\Carbon $ends
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $open
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Result[] $results
 * @property-read \Survey\Models\Customer $customer
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereStarted($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereQuestions($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereGroups($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereWelcomeMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereRememberMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereFinishMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereEnds($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Survey whereUpdatedAt($value)
 */
class Survey extends Model
{
    protected $dates = ['created_at', 'updated_at', 'ends'];

    protected $table = 'surveys';

    protected $fillable = ['name', 'welcome_mail', 'remember_mail', 'finish_mail', 'ends'];

    protected $casts = [
        'questions' => 'array',
        'groups' => 'array',
    ];

    public function getOpenAttribute()
    {
        $now = Carbon::now();
        if (!isset($this->ends)) {
            return true;
        } else {
            return ($this->ends->diff($now)->days == 0);
        }
    }

    public function keys()
    {
        return $this->hasManyThrough('Survey\Models\Key', 'Survey\Models\Result');
    }

    public function results()
    {
        return $this->hasMany('Survey\Models\Result');
    }

    public function customer()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }
}
