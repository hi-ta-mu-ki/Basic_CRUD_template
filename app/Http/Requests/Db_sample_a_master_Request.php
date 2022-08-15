<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Db_sample_a_master_Request extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return ['name' => 'required',
            'price' => 'required|numeric|integer|min:1'];
  }

  public function messages()
  {
    return ["required" => "必須項目です。",
            "numeric" => "数値項目です。",
            "integer" => "整数項目です。",
            "min" => "1以上です。"];
  }
}
