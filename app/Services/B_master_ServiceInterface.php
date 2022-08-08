<?php

namespace App\Services;

interface B_master_ServiceInterface
{
  public function list($keyword);
  public function create($item);
  public function latest();
  public function show($id);
  public function update($id, $item);
  public function delete($id);
}