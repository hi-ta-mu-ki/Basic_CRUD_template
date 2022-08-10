<?php

namespace App\Repositories;

interface O1_transaction_RepositoryInterface
{
  public function all();
  public function search($keyword);
  public function create(array $item);
  public function show($id);
  public function show_latest();
  public function update($id, array $item);
  public function delete($id);
}