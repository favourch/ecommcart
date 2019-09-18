<?php

namespace App\Policies;

use App\User;
use App\Packaging;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view packagings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_packaging'))->check();
    }

    /**
     * Determine whether the user can view the Packaging.
     *
     * @param  \App\User  $user
     * @param  \App\Packaging  $packaging
     * @return mixed
     */
    public function view(User $user, Packaging $packaging)
    {
        return (new Authorize($user, 'view_packaging', $packaging))->check();
    }

    /**
     * Determine whether the user can create Packagings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_packaging'))->check();
    }

    /**
     * Determine whether the user can update the Packaging.
     *
     * @param  \App\User  $user
     * @param  \App\Packaging  $packaging
     * @return mixed
     */
    public function update(User $user, Packaging $packaging)
    {
        return (new Authorize($user, 'edit_packaging', $packaging))->check();
    }

    /**
     * Determine whether the user can delete the Packaging.
     *
     * @param  \App\User  $user
     * @param  \App\Packaging  $packaging
     * @return mixed
     */
    public function delete(User $user, Packaging $packaging)
    {
        return (new Authorize($user, 'delete_packaging', $packaging))->check();
    }
}
