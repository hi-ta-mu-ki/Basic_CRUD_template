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

class Db_sample_transaction_Controller extends Controller
{
  //o1_transaction入力用B_masterリスト
  public function o_new_list(Request $request)
  {
    $keyword = $request->input('keyword');
    if (empty($keyword))
      $items = B_master::orderBy('id', 'asc')->paginate(10);
    else
      $items = B_master::where('name', 'like', '%' . $keyword . '%')->orwhere('tel', 'like', '%' . $keyword . '%')
        ->orderBy('id', 'asc')->paginate(10);
    return view('db_sample.o_new_list', ['items' => $items, 'keyword' => $keyword]);
  }

  //o2_transaction新規入力
  public function o_new($id)
  {
    if (Session::has('b_id')) {
    } else {
      Session::put('b_id', $id);
      $item = B_master::findOrFail($id);
      Session::put('b_name', $item->name);
    }
    $a_items = A_master::All();
    return view('db_sample.o_new', ['a_items' => $a_items]);
  }

  //o2_transaction新規確認
  public function o_new_confirm(Request $request)
  {
    Session::put('tmpFields', $request->moreFields);
    $request->validate(
      ['moreFields.*.quantity' => 'required|numeric|integer'],
      [
        "required" => "数量が入力されていない商品があります。",
        "numeric" => "数量は数値項目です。",
        "integer" => "数量は整数数量は項目です。"
      ]
    );
    $a_names = array();
    foreach (Session::get('tmpFields') as $key => $value) {
      $name = A_master::where('id', '=', $value['a_masters_id'])->select('name')->first();
      $a_names[$key]['name'] = $name->name;
    }
    return view('db_sample.o_new_confirm', ['a_names' => $a_names]);
  }

  //o2_transaction新規完了
  public function o_new_finish()
  {
    $item = new O1_transaction();
    $item->b_masters_id = Session::get('b_id');
    $item->save();
    $o1_item = O1_transaction::latest()->with(['b_masters'])->first();
    foreach (Session::get('tmpFields') as $value) {
      $item = new O2_transaction();
      $item->o1_transactions_id = $o1_item->id;
      $item->a_masters_id = $value['a_masters_id'];
      $item->quantity = $value['quantity'];
      $item->save();
    }
    Session::forget('b_id');
    Session::forget('b_name');
    Session::forget('tmpFields');
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
        ->where('name', 'like', '%' . $keyword . '%')->orwhere('tel', 'like', '%' . $keyword . '%')
        ->orderBy('o1_transactions.id', 'desc')->paginate(10);
    return view('db_sample.o_list', ['items' => $items, 'keyword' => $keyword]);
  }

  //o2_transaction詳細
  public function o_detail($id)
  {
    $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
    $items2 = O2_transaction::where('o1_transactions_id', $id)->with(['a_masters'])->get();
    return view('db_sample.o_detail', ['item1' => $item1, 'items2' => $items2]);
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
    $item = new O2_transaction();
    $item->o1_transactions_id = $id;
    $item->a_masters_id = $request->a_masters_id;
    $item->quantity = $request->quantity;
    $item->save();
    return redirect('db_sample/o_detail/' . $request->o1_id)->with('flashmessage', '登録が完了いたしました。');
  }

  //o1_o2_transaction帳票
  public function o_print($id)
  {
    $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
    $items2 = O2_transaction::where('o1_transactions_id', $id)->with(['a_masters'])->get();
    $t_amount = 0;
    $d_amount = array();
    foreach ($items2 as $key => $item2) {
      $d_amount[$key] = $item2->a_masters->price * $item2->quantity;
      $t_amount += $d_amount[$key];
    }
    return view('db_sample/o_print', [
        'item1' => $item1, 'items2' => $items2,
        'd_amount' => $d_amount, 't_amount' => $t_amount,
      ]);
  }

    //o1_o2_transaction帳票(PDF)
    public function o_pdf($id)
    {
      $item1 = O1_transaction::with(['b_masters'])->findOrFail($id);
      $items2 = O2_transaction::where('o1_transactions_id', $id)->with(['a_masters'])->get();
      $t_amount = 0;
      $d_amount = array();
      foreach ($items2 as $key => $item2) {
        $d_amount[$key] = $item2->a_masters->price * $item2->quantity;
        $t_amount += $d_amount[$key];
      }
      $pdf = PDF::loadView('db_sample/o_pdf', [
        'item1' => $item1, 'items2' => $items2,
        'd_amount' => $d_amount, 't_amount' => $t_amount,
      ])->setPaper('A4');
      // return $pdf->download('Db_sample_print.pdf');
      return $pdf->stream('Db_sample_print.pdf');
    }

}
