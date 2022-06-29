<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Db_sampleRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return ['name'=>'required',];
	}

	public function messages()
	{
		return ["required" => "必須項目です。"];
	}

}