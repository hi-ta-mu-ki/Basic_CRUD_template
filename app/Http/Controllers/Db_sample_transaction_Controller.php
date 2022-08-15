<?php

namespace App\Http\Controllers;

use App\Services\Transaction_ServiceInterface;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class Db_sample_transaction_Controller extends Controller
{

  private Transaction_ServiceInterface $transaction_service;

  public function __construct(Transaction_ServiceInterface $transaction_service)
  {
    $this->transaction_service = $transaction_service;
  }

  //o1_transaction入力用B_masterリスト
  public function o_b_list(Request $request)
  {
    $items = $this->transaction_service->o_b_list($request->input('keyword'))->paginate(10);
    return view('db_sample.o_b_list', ['items' => $items, 'keyword' => $request->input('keyword')]);
  }

  //o2_transaction新規入力
  public function o_new($id1)
  {
    $this->transaction_service->o_new($id1);
    $items = $this->transaction_service->o_a_list();
    return view('db_sample.o_new', ['a_items' => $items, 'id1' => $id1]);
  }

  //o2_transaction新規確認
  public function o_new_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $request)
  {
    $a_names = $this->transaction_service->o_new_confirm($request->moreFields);
    return view('db_sample.o_new_confirm', ['a_names' => $a_names]);
  }

  //o2_transaction新規完了
  public function o_new_finish()
  {
    $this->transaction_service->o_new_finish();
    return redirect('db_sample/o_b_list/')->with('flashmessage', '登録が完了いたしました。');
  }

  //o1_transactionリスト
  public function o1_list(Request $request)
  {
    $items = $this->transaction_service->o1_list($request->input('keyword'))->paginate(10);
    return view('db_sample.o1_list', ['items' => $items, 'keyword' => $request->input('keyword')]);
  }

  //o2_transaction詳細
  public function o2_detail($id1)
  {
    $item1 = $this->transaction_service->o1_show($id1);
    $items2 = $this->transaction_service->o2_list($id1);
    return view('db_sample.o2_detail', ['item1' => $item1, 'items2' => $items2]);
  }

  //o2_transaction編集
  public function o2_edit($id1, $id2)
  {
    $item1 = $this->transaction_service->o1_show($id1);
    $item2 = $this->transaction_service->o2_show($id1, $id2);
    $a_items = $this->transaction_service->o_a_list();
    return view('db_sample.o2_edit', ['item1' => $item1, 'item2' => $item2, 'a_items' => $a_items]);
  }

  //o2_transaction編集確認
  public function o2_edit_confirm(\App\Http\Requests\Db_sample_o2_transaction_Request $request)
  {
    $name = $this->transaction_service->o2_edit_confirm($request->input('a_masters_id'));
    return view('db_sample.o2_edit_confirm', $request->all(), ['name' => $name]);
  }

  //o2_transaction編集完了
  public function o2_edit_finish(Request $request, $id1, $id2)
  {
    $this->transaction_service->o2_edit_finish($id2, $request);
    return redirect('db_sample/o2_detail/' . $id1)->with('flashmessage', '更新が完了いたしました。');
  }

  //o1_ransaction削除
  public function o1_delete($id1)
  {
    $this->transaction_service->o1_delete($id1);
    return redirect('db_sample/o1_list')->with('flashmessage', '削除が完了いたしました。');
  }

  //o2_transaction削除
  public function o2_delete(Request $request, $id2)
  {
    $this->transaction_service->o2_delete($id2);
    return redirect('db_sample/o2_detail/' . $request->o1_id)->with('flashmessage', '削除が完了いたしました。');
  }

  //o2_transaction新規追加入力
  public function o2_new($id1)
  {
    $item1 = $this->transaction_service->o1_show($id1);
    $a_items = $this->transaction_service->o_a_list();
    return view('db_sample.o2_new', ['id1' => $id1, 'item1' => $item1, 'a_items' => $a_items]);
  }

  //o2_transaction新規追加確認
  public function o2_new_confirm(\App\Http\Requests\Db_sample_o2_transaction_add_Request $request)
  {
    $name = $this->transaction_service->o2_edit_confirm($request->input('a_masters_id'));
    return view('db_sample.o2_new_confirm', $request->all(), ['name' => $name]);
  }

  //o2_transaction新規追加完了
  public function o2_new_finish(Request $request, $id1)
  {
    $this->transaction_service->o2_new_finish($request);
    return redirect('db_sample/o2_detail/' . $id1)->with('flashmessage', '登録が完了いたしました。');
  }

  //o1_o2_transaction帳票
  public function o_print($id1)
  {
    $item1 = $this->transaction_service->o1_show($id1);
    $items2 = $this->transaction_service->o2_amount($id1);
    return view(
      'db_sample/o_print', [
        'item1' => $item1, 'items2' => $items2['items'],
        'd_amount' => $items2['d_amount'], 't_amount' => $items2['t_amount']
      ]
    );
  }

  //o1_o2_transaction帳票(PDF)
  public function o_pdf($id1)
  {
    $item1 = $this->transaction_service->o1_show($id1);
    $items2 = $this->transaction_service->o2_amount($id1);
    $pdf = PDF::loadView('db_sample/o_pdf', [
      'item1' => $item1, 'items2' => $items2['items'],
      'd_amount' => $items2['d_amount'], 't_amount' => $items2['t_amount'],
    ])->setPaper('A4');
    // return $pdf->download('Db_sample_print.pdf');
    return $pdf->stream('Db_sample_print.pdf');
  }
}
