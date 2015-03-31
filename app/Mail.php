<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Mail.
 *
 * @property-read \Survey\Token $token
 * @property integer $id
 * @property boolean $sent
 * @property boolean $received
 * @property boolean $error
 * @property integer $token_id
 * @property integer $reason
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereSent($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereReceived($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereError($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereTokenId($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Survey\Mail whereUpdatedAt($value)
 */
class Mail extends Model
{
    public function token()
    {
        return $this->belongsTo('Survey\Token');
    }
}
