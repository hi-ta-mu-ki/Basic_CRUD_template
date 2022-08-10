<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class O2_transaction extends Model
{
  protected $primaryKey = 'id';
  protected $guarded = ['id'];

  public function o1_transactions()
  {
      return $this->belongsTo('App\Models\O1_transaction');
  }

  public function a_masters()
  {
      return $this->belongsTo('App\Models\A_master');
  }

}
