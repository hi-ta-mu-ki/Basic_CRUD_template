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
    if (empty($keyword))
      $items = A_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = A_master::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.a_list',['items' => $items, 'keyword' => $keyword]);
  }

  public function a_new()
  {
    return view('db_sample.a_new');
  }

  public function a_new_confirm(\App\Http\Requests\Db_sample_a_master_Request $req)
  {
    return view('db_sample.a_new_confirm', $req->all());
  }

  public function a_new_finish(Request $request)
  {
    $item = new A_master();
    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect('db_sample/a_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function a_edit($id)
  {
    $item = A_master::findOrFail($id);
    return view('db_sample.a_edit', ['item' => $item]);
  }

  public function a_edit_confirm(\App\Http\Requests\Db_sample_a_master_Request $req)
  {
    return view('db_sample.a_new_confirm', $req->all());
  }

  public function a_edit_finish(Request $request, $id)
  {
    $item = A_master::findOrFail($id);
    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect('db_sample/a_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function a_detail($id)
  {
      $item = A_master::findOrFail($id);
      return view('db_sample.a_detail', ['item' => $item]);
  }

  public function a_delete($id)
  {
    $item = A_master::find($id);
    $item->delete();
    return redirect('db_sample/a_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function b_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = B_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = B_master::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.b_list',['items' => $items, 'keyword' => $keyword]);
  }

  public function b_new()
  {
    return view('db_sample.b_new');
  }

  public function b_new_confirm(\App\Http\Requests\Db_sample_b_master_Request $reqest)
  {
    return view('db_sample.b_new_confirm', $reqest->all());
  }

  public function b_new_finish(Request $request)
  {
    $item = new B_master();
    $item->name = $request->name;
    $item->tel = $request->tel;
    $item->save();
    return redirect('db_sample/o_new_b_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function b_edit($id)
  {
    $item = B_master::findOrFail($id);
    return view('db_sample.b_edit', ['item' => $item]);
  }

  public function b_edit_confirm(\App\Http\Requests\Db_sample_b_master_Request $reqest)
  {
    return view('db_sample.b_new_confirm', $reqest->all());
  }

  public function b_edit_finish(Request $request, $id)
  {
    $item = B_master::findOrFail($id);
    $item->name = $request->name;
    $item->tel = $request->tel;
    $item->save();
    return redirect('db_sample/b_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function b_detail($id)
  {
      $item = B_master::findOrFail($id);
      return view('db_sample.b_detail', ['item' => $item]);
  }

  public function b_delete($id)
  {
    $item = B_master::find($id);
    $item->delete();
    return redirect('db_sample/b_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function user_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = User::orderBy('id', 'asc')->paginate(10);
    else
      $items = User::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.user_list',['items' => $items, 'keyword' => $keyword]);
  }

  public function user_new()
  {
    return view('db_sample.user_new');
  }

  public function user_new_confirm(\App\Http\Requests\Db_sample_user_Request $reqest)
  {
    return view('db_sample.user_new_confirm', $reqest->all());
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
    return redirect('db_sample/user_list')->with('flashmessage', '登録が完了いたしました。');
  }

  public function user_edit($id)
  {
    $item = User::findOrFail($id);
    return view('db_sample.user_edit', ['item' => $item]);
  }

  public function user_edit_confirm(\App\Http\Requests\Db_sample_user_Request $req)
  {
    return view('db_sample.user_new_confirm', $req->all());
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
    return redirect('db_sample/user_list')->with('flashmessage', '更新が完了いたしました。');
  }

  public function user_delete($id)
  {
    $user = User::find($id);
    $user->delete();
    return redirect('db_sample/user_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function o_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = O1_transaction::with(['b_masters'])->orderBy('id', 'desc')->paginate(10);
    else
      $items = O1_transaction::join('b_masters', 'o1_transactions.b_masters_id', '=', 'b_masters.id')->where('tel', 'like', '%' . $keyword . '%')->orderBy('o1_transactions.id', 'desc')->paginate(10);
    return view('db_sample.o_list', ['items' => $items, 'keyword' => $keyword]);
  }

  public function o_edit($id1, $id2)
  {
    $item1 = O1_transaction::with(['b_masters'])->findOrFail($id1);
    $item2 = O2_transaction::where('o1_transactions_id', $id1)->with(['a_masters'])->findOrFail($id2);
    $a_items = A_master::All();
    return view('db_sample.o_edit', ['item1' => $item1, 'item2' => $item2, 'a_items' => $a_items]);
  }

  public function o_edit_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $reqest)
  {
    $name = A_master::where('id', $reqest->input('a_masters_id'))->select('name')->first();
    return view('db_sample.o_edit_confirm', $reqest->all(), ['name' => $name]);
  }

  public function o_edit_finish(Request $request, $id1, $id2)
  {
    $item = O2_transaction::findOrFail($id2);
    $item->a_masters_id = $request->a_masters_id;
    $item->quantity = $request->quantity;
    $item->save();
    return redirect('db_sample/o_detail/' . $id1)->with('flashmessage', '更新が完了いたしました。');
  }

  public function o_detail($id)
  {
      $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
      $items2 = O2_transaction::where('o1_transactions_id', $id)->with(['a_masters'])->get();
      return view('db_sample.o_detail', ['item1' => $item1, 'items2' => $items2,]);
  }

  public function o1_delete($id)
  {
    $user = O1_transaction::find($id);
    $user->delete();
    return redirect('db_sample/o_list')->with('flashmessage', '削除が完了いたしました。');
  }

  public function o2_delete(Request $request, $id)
  {
    $user = O2_transaction::find($id);
    $user->delete();
    return redirect('db_sample/o_detail/' . $request->o1_id)->with('flashmessage', '削除が完了いたしました。');
  }

  public function o_new_b_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = B_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = B_master::where('tel', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.o_new_b_list', ['items' => $items, 'keyword' => $keyword]);
  }

  public function o_b_new($id)
  {
    $item1 = New O1_transaction();
    $item1->b_masters_id = $id;
    $item1->save();
    return redirect('db_sample/o_list');
  }

  public function o_new($id)
  {
    $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
    $a_items = A_master::All();
    return view('db_sample.o_new', ['item1' => $item1, 'a_items' => $a_items]);
  }

  public function o_new_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $reqest)
  {
    $name = A_master::where('id', $reqest->input('a_masters_id'))->select('name')->first();
    return view('db_sample.o_new_confirm', $reqest->all(), ['name' => $name]);
  }

  public function o_new_finish(Request $request, $id)
  {
    $item = New O2_transaction();
    $item->o1_transactions_id = $id;
    $item->a_masters_id = $request->a_masters_id;
    $item->quantity = $request->quantity;
    $item->save();
    return redirect('db_sample/o_detail/' . $request->o1_id)->with('flashmessage', '登録が完了いたしました。');
  }


}
