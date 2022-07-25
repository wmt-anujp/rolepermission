<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait PermissionsTrait
{
    // getting all the permissions
    public function getAllPermissions($permission)
    {
        return Permission::whereIn('name', $permission)->get();
    }

    // checking whether user has permissions or not
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'users_permissions');
    // }

    // public function roles()
    // {
    //     return $this->hasOne(Role::class, 'users_roles');
    // }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    // checking permission via role
    public function hasPermissionThroughRole($permissions)
    {
        foreach ($permissions->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
    }

    // checking is user having to perform some particular action or not
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    // for giving permission to user
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions == null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }
}
