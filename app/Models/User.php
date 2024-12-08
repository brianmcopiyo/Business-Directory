<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasPermissions, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id');
    }
    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'id');
    }

    public function settings()
    {
        return $this->HasOne(UserSetting::class);
    }

    public function tokens()
    {
        return $this->hasMany(AccessToken::class);
    }

    public function token()
    {
        return $this->hasOne(AccessToken::class)->where('status', "Active");
    }

    public function createToken()
    {

        $token = $this->token;

        if ($token) {
            $token->status = "Expired";
            $token->save();
        }

        do {
            $code = Str::random(64);
        } while (AccessToken::where('token', $code)->first());

        return  AccessToken::create([
            'user_id' => $this->id,
            'token' => $code
        ]);
    }
}
