<?php

namespace App\Repositories;

interface O2_transaction_RepositoryInterface
{
  public function list($id);
  public function create(array $item);
  public function show($id1, $id2);
  public function update($id, array $item);
  public function delete($id);
}