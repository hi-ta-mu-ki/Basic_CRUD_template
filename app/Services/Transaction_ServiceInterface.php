<?php

namespace App\Services;

interface Transaction_ServiceInterface
{
  public function o_a_list();
  public function o_b_list($keyword);
  public function o_new($id);
  public function o_new_confirm(array $items);
  public function o_new_finish();
  public function o1_list($keyword);
  public function o1_show($id);
  public function o2_list($id);
  public function o2_show($id1, $id2);
  public function o2_edit_confirm($id);
  public function o2_edit_finish($id, $request);
  public function o1_delete($id);
  public function o2_delete($id);
  public function o2_new_finish($request);
  public function o2_amount($id);
}