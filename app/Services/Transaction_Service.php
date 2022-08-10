<?php

namespace App\Services;

use App\Repositories\A_master_RepositoryInterface;
use App\Services\B_master_ServiceInterface;
use App\Repositories\O1_transaction_RepositoryInterface;
use App\Repositories\O2_transaction_RepositoryInterface;
use Illuminate\Support\Facades\Session;

class Transaction_Service implements Transaction_ServiceInterface
{
  private $a_master_repository;
  private $b_master_service;
  private $o1_transaction_repository;
  private $o2_transaction_repository;

  public function __construct(
    A_master_RepositoryInterface $a_master_repository,
    B_master_ServiceInterface $b_master_service,
    O1_transaction_RepositoryInterface $o1_transaction_repository,
    O2_transaction_RepositoryInterface $o2_transaction_repository
  ) {
    $this->a_master_repository = $a_master_repository;
    $this->b_master_service = $b_master_service;
    $this->o1_transaction_repository = $o1_transaction_repository;
    $this->o2_transaction_repository = $o2_transaction_repository;
  }

  public function o_a_list()
  {
    return $this->a_master_repository->all()->get();
  }

  public function o_b_list($keyword)
  {
    return $this->b_master_service->list($keyword);
  }

  public function o_new($id)
  {
    if (Session::has('b_id')) {
    } else {
      Session::put('b_id', $id);
      $item = $this->b_master_service->show($id);
      Session::put('b_name', $item->name);
    }
  }

  public function o_new_confirm(array $items)
  {
    Session::put('tmpFields', $items);
    $a_names = array();
    foreach (Session::get('tmpFields') as $key => $value) {
      $name = $this->a_master_repository->show($value['a_masters_id']);
      $a_names[$key]['name'] = $name->name;
    }
    return $a_names;
  }

  public function o_new_finish()
  {
    $item = array();
    $item['b_masters_id'] = Session::get('b_id');
    $this->o1_transaction_repository->create($item);
    $o1_item = $this->o1_transaction_repository->show_latest();
    unset($item);
    foreach (Session::get('tmpFields') as $value) {
      $item['o1_transactions_id'] = $o1_item->id;
      $item['a_masters_id'] = $value['a_masters_id'];
      $item['quantity'] = $value['quantity'];
      $this->o2_transaction_repository->create($item);
    }
    Session::forget('b_id');
    Session::forget('b_name');
    Session::forget('tmpFields');
  }

  public function o1_list($keyword)
  {
    if (empty($keyword))
      return $this->o1_transaction_repository->all()->get();
    else
      return $this->o1_transaction_repository->search($keyword);
  }

  public function o1_show($id)
  {
    return $this->o1_transaction_repository->show($id);
  }

  public function o2_list($id)
  {
    return $this->o2_transaction_repository->list($id);
  }

  public function o2_show($id1, $id2)
  {
    return $this->o2_transaction_repository->show($id1, $id2);
  }

  public function o2_edit_confirm($id)
  {
      return $this->a_master_repository->show($id);
  }

  public function o2_edit_finish($id, $item)
  {
    return $this->o2_transaction_repository->update($id, $item);
  }

  public function o1_delete($id)
  {
    return $this->o1_transaction_repository->delete($id);
  }

  public function o2_delete($id)
  {
    return $this->o2_transaction_repository->delete($id);
  }

  public function o2_new_finish($item, $id)
  {
    $item['o1_transactions_id'] = $id;
    $this->o2_transaction_repository->create($item);
  }

  public function o2_amount($id)
  {
    $items = $this->o2_transaction_repository->list($id);
    $t_amount = 0;
    $d_amount = array();
    foreach ($items as $key => $item) {
      $d_amount[$key] = $item->a_masters->price * $item->quantity;
      $t_amount += $d_amount[$key];
    }
    return array('items' => $items, 'd_amount' => $d_amount, 't_amount' => $t_amount);
  }

}
