<?php

namespace App\Http\Controllers;

use App\Models\A_master;
use App\Models\B_master;
use App\Models\User;
use App\Models\O1_transaction;
use App\Models\O2_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Db_sampleController extends Controller
{
  public function home_admin()
  {
    return view('db_sample.home_admin');
  }

  public function a_list(Request $request)
  {
    $keyword = $request->input('keyword');
    $query = A_master::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.a_list')->with('items', $items)->with('keyword',$keyword);;
  }

  public function a_new()
  {
    return view('db_sample.a_new');
  }

  public function a_new_confirm(\App\Http\Requests\Db_sample_a_master_Request $req)
  {
    $data = $req->all();
    return view('db_sample.a_new_confirm')->with($data);
  }

  public function a_new_finish(Request $request)
  {
    $work = new A_master();
    $work->create([
      'name' => $request->name,
      'price' => $request->price,
    ]);
    return redirect()->to('db_sample/a_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function a_edit($id)
  {
    $item = A_master::findOrFail($id);
    return view('db_sample.a_edit')->with('item', $item);
  }

  public function a_edit_confirm(\App\Http\Requests\Db_sample_a_master_Request $req)
  {
    $data = $req->all();
    return view('db_sample.a_edit_confirm')->with($data);
  }

  public function a_edit_finish(Request $request, $id)
  {
    $item = A_master::findOrFail($id);
    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect()->to('db_sample/a_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function a_detail($id)
  {
      $item = A_master::findOrFail($id);
      return view('db_sample.a_detail')->with('item', $item);
  }

  public function a_delete($id)
  {
    $user = A_master::find($id);
    $user->delete();
    return redirect()->to('db_sample/a_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function b_list(Request $request)
  {
    $keyword = $request->input('keyword');
    $query = B_master::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.b_list')->with('items', $items)->with('keyword',$keyword);;
  }

  public function b_new()
  {
    return view('db_sample.b_new');
  }

  public function b_new_confirm(\App\Http\Requests\Db_sample_b_master_Request $req)
  {
    $data = $req->all();
    return view('db_sample.b_new_confirm')->with($data);
  }

  public function b_new_finish(Request $request)
  {
    $work = new B_master();
    $work->create([
      'name' => $request->name,
      'tel' => $request->tel,
    ]);
    return redirect()->to('db_sample/b_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function b_edit($id)
  {
    $item = B_master::findOrFail($id);
    return view('db_sample.b_edit')->with('item', $item);
  }

  public function b_edit_confirm(\App\Http\Requests\Db_sample_b_master_Request $req)
  {
    $data = $req->all();
    return view('db_sample.b_edit_confirm')->with($data);
  }

  public function b_edit_finish(Request $request, $id)
  {
    $item = B_master::findOrFail($id);
    $item->name = $request->name;
    $item->tel = $request->tel;
    $item->save();
    return redirect()->to('db_sample/b_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function b_detail($id)
  {
      $item = B_master::findOrFail($id);
      return view('db_sample.b_detail')->with('item', $item);
  }

  public function b_delete($id)
  {
    $user = B_master::find($id);
    $user->delete();
    return redirect()->to('db_sample/b_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function user_list(Request $request)
  {
    $keyword = $request->input('keyword');
    $query = User::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.user_list')->with('items', $items)->with('keyword',$keyword);;
  }

  public function user_new()
  {
    return view('db_sample.user_new');
  }

  public function user_new_confirm(\App\Http\Requests\Db_sample_user_Request $req)
  {
    $data = $req->all();
    return view('db_sample.user_new_confirm')->with($data);
  }

  public function user_new_finish(Request $request)
  {
    $item = new User();
    $item->email = $request->email;
    $item->name = $request->name;
    $item->password = Hash::make($request->password_raw);
    if($request->role > 5)
      $item->password_raw = $request->password_raw;
    $item->role = $request->role;
    $item->save();
    return redirect()->to('db_sample/user_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function user_edit($id)
  {
    $item = User::findOrFail($id);
    return view('db_sample.user_edit')->with('item', $item);
  }

  public function user_edit_confirm(\App\Http\Requests\Db_sample_user_Request $req)
  {
    $data = $req->all();
    return view('db_sample.user_edit_confirm')->with($data);
  }

  public function user_edit_finish(Request $request, $id)
  {
    $item = User::findOrFail($id);
    $item->email = $request->email;
    $item->name = $request->name;
    $item->password = Hash::make($request->password_raw);
    if($request->role > 5)
      $item->password_raw = $request->password_raw;
    $item->role = $request->role;
    $item->save();
    return redirect()->to('db_sample/user_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function user_delete($id)
  {
    $user = User::find($id);
    $user->delete();
    return redirect()->to('db_sample/user_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function o_list(Request $request)
  {
    $keyword = $request->input('keyword');
    $query = O1_transaction::query();
    if (!empty($keyword)) {
      $query->where('name', 'like', '%' . $keyword . '%');
    }
    $items = $query->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.o_list')->with('items', $items)->with('keyword',$keyword);;
  }

  public function o_new(\App\Http\Requests\Db_sample_o2_transaction_Request $req)
  {
    $a_items = A_master::All();
    $b_items = B_master::All();
    if(empty($req)){
      return view('db_sample.o_new', ['a_items' => $a_items, 'b_items' => $b_items]);
    }else{
      $o_items = O1_transaction::All();
      return view('db_sample.o_new', ['a_items' => $a_items, 'b_items' => $b_items, 'o_items' => $o_items]);
    }
  }

  public function o_new_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $req)
  {
    $data = $req->all();
    $a_items = A_master::All();
    $b_items = B_master::All();
    return view('db_sample.o_new_confirm', ['a_items' => $a_items, 'b_items' => $b_items])->with($data);
  }

  public function o_new_finish(Request $request)
  {
    $work = new O1_transaction();
    $work->create([
      'name' => $request->name,
      'price' => $request->price,
    ]);
    return redirect()->to('db_sample/o_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function o_edit($id)
  {
    $item = O1_transaction::findOrFail($id);
    return view('db_sample.o_edit')->with('item', $item);
  }

  public function o_edit_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $req)
  {
    $data = $req->all();
    return view('db_sample.o_edit_confirm')->with($data);
  }

  public function o_edit_finish(Request $request, $id)
  {
    $item = O1_transaction::findOrFail($id);
    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect()->to('db_sample/o_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function o_detail($id)
  {
      $item = O1_transaction::findOrFail($id);
      return view('db_sample.o_detail')->with('item', $item);
  }

  public function o_delete($id)
  {
    $user = O1_transaction::find($id);
    $user->delete();
    return redirect()->to('db_sample/o_list')->with('flashmessage', '削除が完了いたしました。');
  }

}
