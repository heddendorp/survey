<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Customer
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Iteration[] $iterations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App/Questionnaire[] $questionnaires
 * @property integer $id 
 * @property string $name 
 * @property string $logo 
 * @property string $info_email 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Survey[] $surveys 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Customer whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Customer whereInfoEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Customer whereUpdatedAt($value)
 */
class Customer extends Model {

	public function iterations ()
    {
        return $this->hasMany('Survey\Iteration');
    }

    public function users ()
    {
        return $this->hasMany('Survey\User');
    }

    public function questionnaires ()
    {
        return $this->hasMany('Survey\Questionnaire');
    }

    public function surveys()
    {
        return $this->hasMany('Survey\Survey');
    }

}
