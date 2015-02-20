<?php namespace Survey\Http\Requests;

use Survey\Http\Requests\Request;

class QuestiongroupRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'heading'=>'required',
            'type'=>'required',
            'condition'=>'required'
		];
	}

}
