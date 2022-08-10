<?php

namespace App\Http\Controllers;

use App\Services\B_master_ServiceInterface;
use Illuminate\Http\Request;

class Db_sample_b_master_Controller extends Controller
{
  private B_master_ServiceInterface $b_master_service;

  public function __construct(B_master_ServiceInterface $b_master_service)
  {
    $this->b_master_service = $b_master_service;
  }

  //B_masterリスト
  public function b_list(Request $request)
  {
    $items = $this->b_master_service->list($request->input('keyword'))->paginate(10);
    return view('db_sample.b_list', ['items' => $items, 'keyword' => $request->input('keyword')]);
  }

  //B_master新規入力
  public function b_new()
  {
    return view('db_sample.b_new');
  }

  //B_master新規確認
  public function b_new_confirm(\App\Http\Requests\Db_sample_b_master_Request $request)
  {
    return view('db_sample.b_new_confirm', $request->all());
  }

  //B_master新規完了
  public function b_new_finish(Request $request)
  {
    $item = $request->only(['name', 'tel']);
    $this->b_master_service->create($item);
    $b_masters = $this->b_master_service->latest($item);
    return redirect('/db_sample/o_new/' . $b_masters->id)->with('flashmessage', '登録が完了いたしました。');
  }

  //B_master編集
  public function b_edit($id)
  {
    $item = $this->b_master_service->show($id);
    return view('db_sample.b_edit', ['item' => $item]);
  }

  //B_master編集確認
  public function b_edit_confirm(\App\Http\Requests\Db_sample_b_master_Request $request)
  {
    return view('db_sample.b_new_confirm', $request->all());
  }

  //B_master編集完了
  public function b_edit_finish(Request $request, $id)
  {
    $item = $request->only(['name', 'tel']);
    $this->b_master_service->update($id, $item);
    return redirect('db_sample/b_list')->with('flashmessage', '更新が完了いたしました。');
  }

  //B_master詳細
  public function b_detail($id)
  {
    $item = $this->b_master_service->show($id);
    return view('db_sample.b_detail', ['item' => $item]);
  }

  //B_master削除
  public function b_delete($id)
  {
    $this->b_master_service->delete($id);
    return redirect('db_sample/b_list')->with('flashmessage', '削除が完了いたしました。');
  }
}
