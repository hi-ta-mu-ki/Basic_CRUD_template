<?php

namespace App\Http\Controllers;

use App\Models\A_master;
use App\Models\B_master;
use App\Models\User;
use App\Models\O1_transaction;
use App\Models\O2_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\PDF;

class Db_sample_login_Controller extends Controller
{
  //adminホーム
  public function home_admin()
  {
    return view('db_sample.home_admin');
  }

  //ログイン画面
  public function login()
  {
    if (Auth::check() == false)
      return view('db_sample.login');
    else return redirect()->back();
  }

  //認証
  public function login_post(Request $request)
  {
    if (Auth::check() == false) {
      $this->validate($request, [
        'email' => 'email|required',
        'password' => 'required|min:8'
      ]);
      if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        if (auth()->user()->role == 1 || auth()->user()->role == 5)
          return redirect('db_sample/home_admin');
        else
          return redirect('db_sample/o_new_list');
      } else return redirect()->back();
    } else return redirect('db_sample/login');
  }

  //ログアウト
  public function logout()
  {
    Auth::logout();
    Session::flush();
    return redirect('db_sample/login');
  }
}
