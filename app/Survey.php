<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Survey
 *
 * @property integer $id 
 * @property boolean $open 
 * @property boolean $welcomed 
 * @property integer $customer_id 
 * @property string $questions 
 * @property string $facilities 
 * @property string $groups 
 * @property string $welcome_mail 
 * @property string $remember_mail 
 * @property string $finish_mail 
 * @property string $questionnaire 
 * @property string $name 
 * @property string $end_date 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Answer[] $answers 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Token[] $tokens 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Result[] $result 
 * @property-read \Survey\Customer $customer 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Result[] $results 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereOpen($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereWelcomed($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereQuestions($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereFacilities($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereGroups($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereWelcomeMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereRememberMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereFinishMail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereQuestionnaire($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Survey whereUpdatedAt($value)
 */
class Survey extends Model {

    protected $casts = [
        'members' => 'array',
        'groups' => 'array',
        'questions' => 'array',
        'facilities' => 'array',
    ];

	public function answers()
    {
        return $this->hasMany('Survey\Answer');
    }

    public function tokens()
    {
        return $this->hasMany('Survey\Token');
    }

    public function result()
    {
        return $this->hasMany('Survey\Result');
    }

    public function customer()
    {
        return $this->belongsTo('Survey\Customer');
    }

    public function results()
    {
        return $this->hasMany('Survey\Result');
    }

    public function stringDate()
    {
        return date('d.m.Y',strtotime($this->end_date));
    }

}
