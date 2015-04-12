<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 31.03.2015
 * Time: 23:24.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Answer.
 *
 * @property integer $id
 * @property integer $key_id
 * @property integer $question
 * @property string $answer
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Survey\Models\Key $key
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Answer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Answer whereKeyId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Answer whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Answer whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Answer whereUpdatedAt($value)
 */
class Answer extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'answers';

    protected $fillable = ['answer', 'question'];

    public function key()
    {
        return $this->belongsTo('Survey\Models\Key');
    }
}
