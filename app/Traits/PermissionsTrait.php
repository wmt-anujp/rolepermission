<?php

namespace App\Traits;

use App\Models\Permission;

trait PermissionsTrait
{
    // getting all the permissions
    public function getAllPermissions($permission)
    {
        return Permission::whereIn('name', $permission)->get();
    }

    // checking wheather user has permissions or not
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

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

    // checking permission via role
    public function hasPermissionThroughRole($permissions)
    {
        foreach ($permissions->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
    }
}
