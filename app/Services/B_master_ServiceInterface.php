<?php

namespace App\Services;

interface B_master_ServiceInterface
{
  public function list($keyword);
  public function create($request);
  public function latest();
  public function show($id);
  public function update($id, $request);
  public function delete($id);
}