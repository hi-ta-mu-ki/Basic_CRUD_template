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

class Db_sample_a_master_Controller extends Controller
{
  //A_masterリスト
  public function a_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = A_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = A_master::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.a_list', ['items' => $items, 'keyword' => $keyword]);
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
    $item = new A_master();
    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect('db_sample/a_list')->with('flashmessage', '登録が完了いたしました。');
  }

  //A_master編集
  public function a_edit($id)
  {
    $item = A_master::findOrFail($id);
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
    $item = A_master::findOrFail($id);
    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect('db_sample/a_list')->with('flashmessage', '更新が完了いたしました。');
  }

  //A_master詳細
  public function a_detail($id)
  {
    $item = A_master::findOrFail($id);
    return view('db_sample.a_detail', ['item' => $item]);
  }

  //A_master削除
  public function a_delete($id)
  {
    $item = A_master::find($id);
    $item->delete();
    return redirect('db_sample/a_list')->with('flashmessage', '削除が完了いたしました。');
  }

}
