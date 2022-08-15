<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Db_sample_o2_transaction_add_Request extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return ['quantity' => 'required|numeric|integer|min:1'];
  }

  public function messages()
  {
    return ["required" => "数量が入力されていない商品があります。",
            "numeric" => "数量は数値項目です。",
            "integer" => "数量は整数数量は項目です。",
            "min" => "数量は1以上です。"];
  }
}
