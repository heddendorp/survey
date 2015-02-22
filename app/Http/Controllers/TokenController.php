<?php namespace Survey\Http\Controllers;

use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TokenController extends Controller {

	public function key($key)
    {
        return $key;
    }

}
