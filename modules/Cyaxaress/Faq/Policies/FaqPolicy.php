<?php


namespace Cyaxaress\Faq\Policies;


use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_SHOW_FAQS);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_CREATE_FAQS);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_UPDATE_FAQS);
    }


    public function delete(User $user)
    {

        if($user->hasPermissionTo(Permission::PERMISSION_DELETE_FAQS))
            return true;
        return null;
    }

    public function changeStatus(User $user)
    {

               if($user->hasPermissionTo(Permission::PERMISSION_CHANGE_STATUS_FAQS))
                   return true;
        return null;
    }
}
