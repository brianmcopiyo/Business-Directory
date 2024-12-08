<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function branches()
  {
    return $this->hasMany(Branch::class);
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function subscription()
  {
    return $this->belongsTo(Subscription::class);
  }
}
