<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $guarded = [];

    public function userDetails()
    {
        return $this->belongsTo(User::class, 'user_id' ,'id');
    }
}
