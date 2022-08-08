<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class A_master extends Model
{
  protected $primaryKey = 'id';
  protected $guarded = ['id'];

  public function o2_transactions()
  {
      return $this->hasMany('App\Models\O2_transaction');
  }

}
