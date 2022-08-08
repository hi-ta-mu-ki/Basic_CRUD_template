<?php

namespace App\Http\Controllers;

use App\Services\User_ServiceInterface;
use Illuminate\Http\Request;

class Db_sample_user_Controller extends Controller
{
  private User_ServiceInterface $user_service;

  public function __construct(User_ServiceInterface $user_service)
  {
      $this->user_service = $user_service;
  }

  //ユーザリスト
  public function user_list(Request $request)
  {
      $items = $this->user_service->list($request->input('keyword'))->paginate(10);
      return view('db_sample.user_list', ['items' => $items, 'keyword' => $request->input('keyword')]);
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
    $item = $request->only(['email', 'name', 'password_raw', 'role']);
    $this->user_service->create($item);
    return redirect('db_sample/user_list')->with('flashmessage', '登録が完了いたしました。');
  }

  //ユーザ編集
  public function user_edit($id)
  {
    $item = $this->user_service->show($id);
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
    $item = $request->only(['email', 'name', 'password_raw', 'role']);
    $this->user_service->update($id, $item);
    return redirect('db_sample/user_list')->with('flashmessage', '更新が完了いたしました。');
  }

  //ユーザ削除
  public function user_delete($id)
  {
    $this->user_service->delete($id);
    return redirect('db_sample/user_list')->with('flashmessage', '削除が完了いたしました。');
  }

}
