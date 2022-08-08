<?php

namespace App\Repositories;

interface A_master_RepositoryInterface
{
  public function all();
  public function search($keyword);
  public function create(array $item);
  public function show($id);
  public function update($id, array $item);
  public function delete($id);
}