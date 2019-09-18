<?php

namespace App\Policies;

use App\User;
use App\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $Permission
     * @return mixed
     */
    public function view(User $user, Permission $Permission)
    {
        return false;
    }

    /**
     * Determine whether the user can create Permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the Permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $Permission
     * @return mixed
     */
    public function update(User $user, Permission $Permission)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the Permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $Permission
     * @return mixed
     */
    public function delete(User $user, Permission $Permission)
    {
        return false;
    }
}
