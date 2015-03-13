<?php namespace Survey;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Survey\User
 *
 * @property-read \Survey\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Group[] $groups
 * @property integer $id 
 * @property string $username 
 * @property string $email 
 * @property string $password 
 * @property integer $customer_id 
 * @property string $remember_token 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $role 
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\User whereRole($value)
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    protected $casts = [
        'role' => 'array',
    ];

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function customer ()
    {
        return $this->belongsTo('Survey\Customer');
    }

    public function groups ()
    {
        return $this->belongsToMany('Survey\Group');
    }

}
