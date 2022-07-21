<?php

namespace App\Models;

use App\Traits\PermissionsTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, PermissionsTrait;
    protected $table = 'users';
    protected $guard = 'user';
    protected $fillable = ['name', 'email', 'password'];

    public function roles()
    {
        return $this->hasOne(Role::class, 'role_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_id', 'id');
    }
}
