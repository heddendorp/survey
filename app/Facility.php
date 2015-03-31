<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */

/**
 * Survey\Facility.
 *
 * @property-read \Survey\Iteration $iteration
 * @property-read \Illuminate\Database\Eloquent\Collection|\Survey\Group[] $groups
 * @property integer $id
 * @property integer $iteration_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Facility whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Facility whereIterationId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Facility whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Facility whereUpdatedAt($value)
 */
class Facility extends Model
{
    public function iteration()
    {
        return $this->belongsTo('Survey\Iteration');
    }

    public function groups()
    {
        return $this->hasMany('Survey\Group');
    }
}
