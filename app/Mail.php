<?php namespace Survey;

use Illuminate\Database\Eloquent\Model;

/**
 * Survey\Mail
 *
 * @property-read \Survey\Token $token 
 */
class Mail extends Model {

	public function token ()
    {
        return $this->belongsTo('Survey\Token');
    }

}
