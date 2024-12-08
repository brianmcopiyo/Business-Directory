<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function business()
  {
    return $this->belongsTo(Business::class);
  }

  public function customer()
  {
    return $this->business->customer;
  }
}
