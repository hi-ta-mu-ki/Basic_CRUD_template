<?php

namespace App\Http\Controllers;

use App\Services\A_master_ServiceInterface;
use Illuminate\Http\Request;

class Db_sample_a_master_Controller extends Controller
{
  private A_master_ServiceInterface $a_master_service;

  public function __construct(A_master_ServiceInterface $a_master_service)
  {
    $this->a_master_service = $a_master_service;
  }

  //A_masterリスト
  public function a_list(Request $request)
  {
    $items = $this->a_master_service->list($request->input('keyword'))->paginate(10);
    return view('db_sample.a_list', ['items' => $items, 'keyword' => $request->input('keyword')]);
  }

  //A_master新規入力
  public function a_new()
  {
    return view('db_sample.a_new');
  }

  //A_master新規確認
  public function a_new_confirm(\App\Http\Requests\Db_sample_a_master_Request $req)
  {
    return view('db_sample.a_new_confirm', $req->all());
  }

  //A_master新規完了
  public function a_new_finish(Request $request)
  {
    $this->a_master_service->create($request);
    return redirect('db_sample/a_list')->with('flashmessage', '登録が完了いたしました。');
  }

  //A_master編集
  public function a_edit($id)
  {
    $item = $this->a_master_service->show($id);
    return view('db_sample.a_edit', ['item' => $item]);
  }

  //A_master編集確認
  public function a_edit_confirm(\App\Http\Requests\Db_sample_a_master_Request $req)
  {
    return view('db_sample.a_new_confirm', $req->all());
  }

  //A_master編集完了
  public function a_edit_finish(Request $request, $id)
  {
    $this->a_master_service->update($id, $request);
    return redirect('db_sample/a_list')->with('flashmessage', '更新が完了いたしました。');
  }

  //A_master詳細
  public function a_detail($id)
  {
    $item = $this->a_master_service->show($id);
    return view('db_sample.a_detail', ['item' => $item]);
  }

  //A_master削除
  public function a_delete($id)
  {
    $this->a_master_service->delete($id);
    return redirect('db_sample/a_list')->with('flashmessage', '削除が完了いたしました。');
  }
}
