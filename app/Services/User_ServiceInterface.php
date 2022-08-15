<?php

namespace App\Services;

interface User_ServiceInterface
{
  public function list($keyword);
  public function create($request);
  public function show($id);
  public function update($id, $request);
  public function delete($id);
}