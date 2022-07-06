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
//adminホーム
  public function home_admin()
  {
    return view('db_sample.home_admin');
  }

//A_masterリスト
  public function a_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = A_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = A_master::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.a_list',['items' => $items, 'keyword' => $keyword]);
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

//B_masterリスト
  public function b_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = B_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = B_master::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.b_list',['items' => $items, 'keyword' => $keyword]);
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
    return redirect('/db_sample/o_b_new2/' . $b_masters->id)->with('flashmessage', '登録が完了いたしました。');
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

//ユーザリスト
  public function user_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = User::orderBy('id', 'asc')->paginate(10);
    else
      $items = User::where('name', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.user_list',['items' => $items, 'keyword' => $keyword]);
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
    if($request->role > 5)
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
    if($request->role > 5)
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

//o1_transaction入力用B_masterリスト
  public function o_new_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = B_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = B_master::where('tel', 'like', '%' . $keyword . '%')->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.o_new_list', ['items' => $items, 'keyword' => $keyword]);
  }

//o2_transaction新規入力
  public function o_new($id)
  {
    $item = New O1_transaction();
    $item->b_masters_id = $id;
    $item->save();
    $item = O1_transaction::latest()->with(['b_masters'])->first();
    $a_items = A_master::All();
    return view('db_sample.o_new', ['item' => $item, 'a_items' => $a_items]);
  }

//o2_transaction新規確認
  public function o_new_confirm(\App\Http\Requests\Db_sample_o_transaction_Request $request)
  {
    $item = O1_transaction::where('id', '=', $request->o1_id)->with(['b_masters'])->first();
    $o_items = array(array());
    foreach ($request->moreFields as $key => $value) {
      $o_items[$key]['a_masters_id'] = $value['a_masters_id'];
      $name = A_master::where('id', '=', $value['a_masters_id'])->select('name')->first();
      $o_items[$key]['name'] = $name->name;
      $o_items[$key]['quantity'] = $value['quantity'];
    }
    return view('db_sample.o_new_confirm', ['item' => $item, 'o_items' => $o_items]);
  }

//o2_transaction新規完了
  public function o_new_finish(Request $request)
  {
    foreach ($request->o_items_a_masters_id as $key => $value) {
      $item = New O2_transaction();
      $item->o1_transactions_id = $request->o1_id;
      $item->a_masters_id = $value;
      $item->quantity = $request->o_items_quantity[$key];
      $item->save();
    }
    return redirect('db_sample/o_new_list/')->with('flashmessage', '登録が完了いたしました。');
  }

//o1_transactionリスト
  public function o_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = O1_transaction::with(['b_masters'])->orderBy('id', 'desc')->paginate(10);
    else
      $items = O1_transaction::join('b_masters', 'o1_transactions.b_masters_id', '=', 'b_masters.id')
        ->where('tel', 'like', '%' . $keyword . '%')->orderBy('o1_transactions.id', 'desc')->paginate(10);
    return view('db_sample.o_list', ['items' => $items, 'keyword' => $keyword]);
  }

//o2_transaction詳細
  public function o_detail($id)
  {
      $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
      $items2 = O2_transaction::where('o1_transactions_id', $id)->with(['a_masters'])->get();
      return view('db_sample.o_detail', ['item1' => $item1, 'items2' => $items2,]);
  }

//o2_transaction編集
  public function o_edit($id1, $id2)
  {
    $item1 = O1_transaction::with(['b_masters'])->findOrFail($id1);
    $item2 = O2_transaction::where('o1_transactions_id', $id1)->with(['a_masters'])->findOrFail($id2);
    $a_items = A_master::All();
    return view('db_sample.o_edit', ['item1' => $item1, 'item2' => $item2, 'a_items' => $a_items]);
  }

//o2_transaction編集確認
  public function o_edit_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $request)
  {
    $name = A_master::where('id', $request->input('a_masters_id'))->select('name')->first();
    return view('db_sample.o_edit_confirm', $request->all(), ['name' => $name]);
  }

//o2_transaction編集完了
  public function o_edit_finish(Request $request, $id1, $id2)
  {
    $item = O2_transaction::findOrFail($id2);
    $item->a_masters_id = $request->a_masters_id;
    $item->quantity = $request->quantity;
    $item->save();
    return redirect('db_sample/o_detail/' . $id1)->with('flashmessage', '更新が完了いたしました。');
  }

//o1_ransaction削除
  public function o1_delete($id)
  {
    $user = O1_transaction::find($id);
    $user->delete();
    return redirect('db_sample/o_list')->with('flashmessage', '削除が完了いたしました。');
  }

//o2_transaction削除
  public function o2_delete(Request $request, $id)
  {
    $user = O2_transaction::find($id);
    $user->delete();
    return redirect('db_sample/o_detail/' . $request->o1_id)->with('flashmessage', '削除が完了いたしました。');
  }

//o2_transaction新規追加入力
  public function o_new2($id)
  {
    $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
    $a_items = A_master::All();
    return view('db_sample.o_new2', ['item1' => $item1, 'a_items' => $a_items]);
  }

//o2_transaction新規追加確認
  public function o_new2_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $request)
  {
    $name = A_master::where('id', $request->input('a_masters_id'))->select('name')->first();
    return view('db_sample.o_new2_confirm', $request->all(), ['name' => $name]);
  }

//o2_transaction新規追加完了
  public function o_new2_finish(Request $request, $id)
  {
    $item = New O2_transaction();
    $item->o1_transactions_id = $id;
    $item->a_masters_id = $request->a_masters_id;
    $item->quantity = $request->quantity;
    $item->save();
    return redirect('db_sample/o_detail/' . $request->o1_id)->with('flashmessage', '登録が完了いたしました。');
  }

}
