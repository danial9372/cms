<?php


namespace Cyaxaress\Setting\Policies;


use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_SHOW_SETTINGS);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_CREATE_SETTINGS);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_UPDATE_SETTINGS);
    }
    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_DELETE_SETTINGS)) return true;
        return null;
    }

}
