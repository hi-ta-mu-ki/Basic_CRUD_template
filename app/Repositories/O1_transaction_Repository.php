<?php

namespace App\Repositories;

use App\Models\O1_transaction;

class O1_transaction_Repository implements O1_transaction_RepositoryInterface
{
  public function all()
  {
    return O1_transaction::with(['b_masters'])->orderBy('id', 'desc');
  }

  public function search($keyword)
  {
    return O1_transaction::join('b_masters', 'o1_transactions.b_masters_id', '=', 'b_masters.id')
      ->where('name', 'like', '%' . $keyword . '%')->orwhere('tel', 'like', '%' . $keyword . '%')
      ->orderBy('o1_transactions.id', 'desc');
  }

  public function create(array $item)
  {
    return O1_transaction::create($item);
  }

  public function show($id)
  {
    return O1_transaction::with(['b_masters'])->findOrFail($id);
  }

  public function show_latest()
  {
    return O1_transaction::latest()->with(['b_masters'])->first();
  }
  public function update($id, array $item)
  {
    return O1_transaction::findOrFail($id)->update($item);
  }

  public function delete($id)
  {
    return O1_transaction::destroy($id);
  }
}
