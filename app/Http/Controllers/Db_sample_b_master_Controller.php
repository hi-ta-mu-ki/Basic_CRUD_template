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

class Db_sample_b_master_Controller extends Controller
{
  //B_masterリスト
  public function b_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = B_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = B_master::where('name', 'like', '%' . $keyword . '%')->orwhere('tel', 'like', '%' . $keyword . '%')
        ->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.b_list', ['items' => $items, 'keyword' => $keyword]);
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
    $item = new B_master();
    $item->name = $request->name;
    $item->tel = $request->tel;
    $item->save();
    $b_masters = B_master::latest()->first();
    return redirect('/db_sample/o_new/' . $b_masters->id)->with('flashmessage', '登録が完了いたしました。');
  }

  //B_master編集
  public function b_edit($id)
  {
    $item = B_master::findOrFail($id);
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
    $item = B_master::findOrFail($id);
    $item->name = $request->name;
    $item->tel = $request->tel;
    $item->save();
    return redirect('db_sample/b_list')->with('flashmessage', '更新が完了いたしました。');
  }

  //B_master詳細
  public function b_detail($id)
  {
    $item = B_master::findOrFail($id);
    return view('db_sample.b_detail', ['item' => $item]);
  }

  //B_master削除
  public function b_delete($id)
  {
    $item = B_master::find($id);
    $item->delete();
    return redirect('db_sample/b_list')->with('flashmessage', '削除が完了いたしました。');
  }
}
