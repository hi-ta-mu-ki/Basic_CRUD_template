<?php

namespace App\Library;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class DataFormat
{
  public static function user_format($request)
  {
    $item = $request->all();
    $item['password'] = Hash::make($item['password_raw']);
    if ($item['role'] == User::ADMIN || $item['role'] == User::CHIEF)
      $item['password_raw'] = "";
    return $item;
  }
}