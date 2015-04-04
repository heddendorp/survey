<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 08:48.
 */

namespace Survey\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Survey\Models\User.
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $admin
 * @property-read \Survey\Models\Customer $customer
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\User whereUpdatedAt($value)
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'role' => 'array',
    ];

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Hashes the password before setting it.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    /**
     * Returns the current admin status.
     *
     * @return bool
     */
    public function getAdminAttribute()
    {
        return $this->role['admin'];
    }

    /**
     * Sets the Admin attribute in the Role Array.
     *
     * @param $admin
     */
    public function setAdminAttribute($admin)
    {
        if ($admin) {
            $this->role = ['admin' => true];
        } else {
            $this->role['admin'] = false;
        }
    }

    /**
     * Returns the associated Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('Survey\Models\Customer');
    }
}
