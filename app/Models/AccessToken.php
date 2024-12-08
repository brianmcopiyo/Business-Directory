<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $table = "personal_access_tokens";

    protected $guarded = [];
}
