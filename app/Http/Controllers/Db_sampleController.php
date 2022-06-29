<?php

namespace App\Http\Controllers;

use App\Models\A_master;
use App\Models\B_master;
use Illuminate\Http\Request;

class Db_sampleController extends Controller
{
  public function home_admin()
  {
    return view('db_sample.home_admin');
  }

  public function a_getindex(Request $request)
  {
    //キーワード受け取り
    $keyword = $request->input('keyword');
    //クエリ生成
    $query = A_master::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.a_list', ['items' => $items])->with('keyword',$keyword);;
  }

  public function a_new_index()
  {
    return view('db_sample.a_new_index');
  }

  public function a_new_confirm(\App\Http\Requests\Db_sampleRequest $req)
  {
    $data = $req->all();
    return view('db_sample.a_new_confirm')->with($data);
  }

  public function a_new_finish(Request $request)
  {
    // オブジェクト生成
    $work = new A_master();
    // 値の登録
    $work->create([
      'name' => $request->name,
    ]);
    // 一覧にリダイレクト
    return redirect()->to('db_sample/a_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function a_edit_index($id)
  {
    $item = A_master::findOrFail($id);
    return view('db_sample.a_edit_index')->with('item', $item);
  }

  public function a_edit_confirm(\App\Http\Requests\Db_sampleRequest $req)
  {
    $data = $req->all();
    return view('db_sample.a_edit_confirm')->with($data);
  }

  public function a_edit_finish(Request $request, $id)
  {
    //レコードを検索
    $item = A_master::findOrFail($id);
    //値を代入
    $item->name = $request->name;
    //保存（更新）
    $item->save();
    //リダイレクト
    return redirect()->to('db_sample/a_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function a_detail($id)
  {
      $item = A_master::findOrFail($id);
      return view('db_sample.a_detail')->with('item', $item);
  }

  public function a_delete($id)
  {
    //削除対象レコードを検索
    $user = A_master::find($id);
    //削除
    $user->delete();
    //リダイレクト
    return redirect()->to('db_sample/a_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function b_getindex(Request $request)
  {
    //キーワード受け取り
    $keyword = $request->input('keyword');
    //クエリ生成
    $query = B_master::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.b_list', ['items' => $items])->with('keyword',$keyword);;
  }

  public function b_new_index()
  {
    return view('db_sample.b_new_index');
  }

  public function b_new_confirm(\App\Http\Requests\Db_sampleRequest $req)
  {
    $data = $req->all();
    return view('db_sample.b_new_confirm')->with($data);
  }

  public function b_new_finish(Request $request)
  {
    // オブジェクト生成
    $work = new B_master();
    // 値の登録
    $work->create([
      'name' => $request->name,
    ]);
    // 一覧にリダイレクト
    return redirect()->to('db_sample/b_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function b_edit_index($id)
  {
    $item = B_master::findOrFail($id);
    return view('db_sample.b_edit_index')->with('item', $item);
  }

  public function b_edit_confirm(\App\Http\Requests\Db_sampleRequest $req)
  {
    $data = $req->all();
    return view('db_sample.b_edit_confirm')->with($data);
  }

  public function b_edit_finish(Request $request, $id)
  {
    //レコードを検索
    $item = B_master::findOrFail($id);
    //値を代入
    $item->name = $request->name;
    //保存（更新）
    $item->save();
    //リダイレクト
    return redirect()->to('db_sample/b_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function b_detail($id)
  {
      $item = B_master::findOrFail($id);
      return view('db_sample.b_detail')->with('item', $item);
  }

  public function b_delete($id)
  {
    //削除対象レコードを検索
    $user = B_master::find($id);
    //削除
    $user->delete();
    //リダイレクト
    return redirect()->to('db_sample/b_list')->with('flashmessage', '削除が完了いたしました。');
  }


  public function getindex(Request $request)
  {
    //キーワード受け取り
    $keyword = $request->input('keyword');
    //クエリ生成
    $query = A_master::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.list', ['items' => $items])->with('keyword',$keyword);;
  }

  public function detail($id)
  {
      $item = A_master::findOrFail($id);
      return view('db_sample.detail')->with('item', $item);
  }

}
