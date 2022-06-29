<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Db_sample_b_master_Request extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return ['name' => 'required',
            'tel' => 'required'];
  }

  public function messages()
  {
    return ["required" => "必須項目です。"];
  }
}
