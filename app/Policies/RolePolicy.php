<?php

namespace App\Policies;

use App\User;
use App\Role;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_role'))->check();
    }

    /**
     * Determine whether the user can view the Role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        return (new Authorize($user, 'view_role', $role))->check();
    }

    /**
     * Determine whether the user can create Roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_role'))->check();
    }

    /**
     * Determine whether the user can update the Role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return (new Authorize($user, 'edit_role', $role))->check();
    }

    /**
     * Determine whether the user can delete the Role.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        return (new Authorize($user, 'delete_role', $role))->check();
    }
}
