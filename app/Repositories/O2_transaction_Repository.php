<?php

namespace App\Repositories;

use App\Models\O2_transaction;

class O2_transaction_Repository implements O2_transaction_RepositoryInterface
{
  public function list($id)
  {
    return O2_transaction::where('o1_transactions_id', $id)->with(['a_masters'])->get();
  }

  public function create(array $item)
  {
    return O2_transaction::create($item);
  }

  public function show($id1, $id2)
  {
    return O2_transaction::where('o1_transactions_id', $id1)->with(['a_masters'])->findOrFail($id2);
  }

  public function update($id, array $item)
  {
    return O2_transaction::findOrFail($id)->update($item);
  }

  public function delete($id)
  {
    return O2_transaction::destroy($id);
  }
}
