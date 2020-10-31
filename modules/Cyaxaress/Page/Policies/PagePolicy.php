<?php


namespace Cyaxaress\Page\Policies;


use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_SHOW_PAGES);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_CREATE_PAGES);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_UPDATE_PAGES);
    }

    public function delete(User $user)
    {

        if ($user->hasPermissionTo(Permission::PERMISSION_DELETE_PAGES)) return true;
        return null;

    }

    public function changeStatus(User $user)
    {

        if ($user->hasPermissionTo(Permission::PERMISSION_CHANGE_STATUS_PAGES)) return true;
        return null;

    }
}
