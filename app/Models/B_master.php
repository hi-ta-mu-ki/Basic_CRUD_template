<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B_master extends Model
{
  protected $primaryKey = 'id';
  protected $guarded = ['id'];

  public function o1_transactions()
  {
      return $this->hasMany('App\Models\O1_transaction');
  }

}
