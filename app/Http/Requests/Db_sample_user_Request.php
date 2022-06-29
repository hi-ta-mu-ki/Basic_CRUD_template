<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Db_sample_user_Request extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return ['email' => 'required|email',
            'name' => 'required',
            'password_raw' => 'required'];
  }

  public function messages()
  {
    return ["required" => "必須項目です。",
            "email" => "メールアドレスの形式ではありません。"];
  }
}
