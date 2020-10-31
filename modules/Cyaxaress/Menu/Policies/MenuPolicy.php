<?php


namespace Cyaxaress\Menu\Policies;


use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_SHOW_MENUS);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_CREATE_MENUS);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_UPDATE_MENUS);
    }


    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_DELETE_MENUS)) return true;
        return null;
    }

    public function changeStatus(User $user)
    {

        if ($user->hasPermissionTo(Permission::PERMISSION_CHANGE_STATUS_MENUS)) return true;
        return null;
    }


}
