<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Db_sample_o2_transaction_Request extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return ['quantity' => 'required|numeric|integer'];
  }

  public function messages()
  {
    return ["required" => "必須項目です。",
            "numeric" => "数値項目です。",
            "integer" => "整数項目です。"];
  }
}
