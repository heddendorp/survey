<?php

/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 30.03.2015
 * Time: 12:55.
 */

namespace Survey\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Models\Question
 *
 * @property integer $id 
 * @property integer $batch_id 
 * @property string $content 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Survey\Models\Batch $batch 
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Question whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Question whereBatchId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Question whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Models\Question whereUpdatedAt($value)
 */
class Question extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $table = 'questions';

    protected $fillable = ['content'];

    public function batch()
    {
        return $this->belongsTo('Survey\Models\Batch');
    }
}
