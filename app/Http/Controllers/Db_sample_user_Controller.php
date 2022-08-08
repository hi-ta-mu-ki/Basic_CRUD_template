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

class Db_sample_user_Controller extends Controller
{
  //ユーザリスト
  public function user_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = User::orderBy('id', 'asc')->paginate(10);
    else
      $items = User::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.user_list', ['items' => $items, 'keyword' => $keyword]);
  }

  //ユーザ新規入力
  public function user_new()
  {
    return view('db_sample.user_new');
  }

  //ユーザ新規確認
  public function user_new_confirm(\App\Http\Requests\Db_sample_user_Request $request)
  {
    return view('db_sample.user_new_confirm', $request->all());
  }

  //ユーザ新規完了
  public function user_new_finish(Request $request)
  {
    $item = new User();
    $item->email = $request->email;
    $item->name = $request->name;
    $item->password = Hash::make($request->password_raw);
    if ($request->role > 5)
      $item->password_raw = $request->password_raw;
    $item->role = $request->role;
    $item->save();
    return redirect('db_sample/user_list')->with('flashmessage', '登録が完了いたしました。');
  }

  //ユーザ編集
  public function user_edit($id)
  {
    $item = User::findOrFail($id);
    return view('db_sample.user_edit', ['item' => $item]);
  }

  //ユーザ編集確認
  public function user_edit_confirm(\App\Http\Requests\Db_sample_user_Request $req)
  {
    return view('db_sample.user_new_confirm', $req->all());
  }

  //ユーザ編集完了
  public function user_edit_finish(Request $request, $id)
  {
    $item = User::findOrFail($id);
    $item->email = $request->email;
    $item->name = $request->name;
    $item->password = Hash::make($request->password_raw);
    if ($request->role > 5)
      $item->password_raw = $request->password_raw;
    $item->role = $request->role;
    $item->save();
    return redirect('db_sample/user_list')->with('flashmessage', '更新が完了いたしました。');
  }

  //ユーザ削除
  public function user_delete($id)
  {
    $user = User::find($id);
    $user->delete();
    return redirect('db_sample/user_list')->with('flashmessage', '削除が完了いたしました。');
  }

}
