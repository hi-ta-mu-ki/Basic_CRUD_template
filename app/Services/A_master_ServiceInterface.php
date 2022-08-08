<?php

namespace App\Services;

interface A_master_ServiceInterface
{
  public function list($keyword);
  public function create($item);
  public function show($id);
  public function update($id, $item);
  public function delete($id);
}