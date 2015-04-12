<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Child.
 *
 * @property-read \Survey\Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Token[] $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Answer[] $answers
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Child whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Child whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Child whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Child whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Child whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Child whereUpdatedAt($value)
 */
class Child extends Model
{
    public function group()
    {
        return $this->belongsTo('Survey\Group');
    }
}
