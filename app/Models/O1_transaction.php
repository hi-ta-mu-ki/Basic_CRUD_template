<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class O1_transaction extends Model
{
  protected $primaryKey = 'id';
  protected $guarded = ['id'];

  public function b_masters()
  {
      return $this->belongsTo('App\Models\B_master');
  }

  public function o2_transactions()
  {
      return $this->hasMany('App\Models\O2_transaction');
  }

}
