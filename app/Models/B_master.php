<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B_master extends Model
{
  protected $primaryKey = 'id';
  protected $guarded = ['id'];

  public function scopeAll($query)
  {
    return $query->all()->orderBy('id', 'asc')->paginate(10);
  }

  public function scopeId2($query, $id)
  {
    return $query->where('id', $id);
  }

  public function scopeId($query, $id)
  {
    return $query->where('id', $id)->orderBy('id', 'asc')->paginate(10);
  }

  public function scopeNamelike($query, $name)
  {
    return $query->whereor('name', 'like', '%' . $name . '%')->orderBy('id', 'asc')->paginate(10);
  }

  public function o1_transactions()
  {
      return $this->hasMany('App\Models\O1_transaction');
  }

}
