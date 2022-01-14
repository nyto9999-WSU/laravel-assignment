<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticationLoggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    //mod
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    //testtest
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function isAdmin()
    {
       return $this->role->name == 'admin';
    }

    public function getRole()
    {
        return $this->role->name;
    }

    public function authenticationLog()
    {
        return $this->morphOne(AuthenticationLog::class, 'authenticatable');
    }

    public function scopeTechnicians($query)
    {
        $query->where('role_id', '=', 3);
    }
}
