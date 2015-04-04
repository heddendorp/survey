<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 13:11.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Key.
 *
 * @property integer $id
 * @property integer $result_id
 * @property integer $progress
 * @property string $name
 * @property string $email
 * @property string $token
 * @property boolean $finished
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Mail[] $mails
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Models\Answer[] $answers
 * @property-read \Survey\Models\Result $result
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereResultId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereProgress($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereFinished($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Key whereUpdatedAt($value)
 */
class Key extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'keys';

    public function mails()
    {
        return $this->hasMany('Survey\Models\Mail');
    }

    public function answers()
    {
        return $this->hasMany('Survey\Models\Answer');
    }

    public function result()
    {
        return $this->belongsTo('Survey\Models\Result');
    }
}
