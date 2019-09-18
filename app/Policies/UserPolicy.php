<?php

namespace App\Policies;

use App\User;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_user'))->check();
    }

    /**
     * Determine whether the user can view the User.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return (new Authorize($user, 'view_user', $model))->check();
    }

    /**
     * Determine whether the user can create Users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_user'))->check();
    }

    /**
     * Determine whether the user can update the User.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return (new Authorize($user, 'edit_user', $model))->check();
    }

    /**
     * Determine whether the user can delete the User.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return (new Authorize($user, 'delete_user', $model))->check();
    }

    /**
     * Determine whether the user can secreatly login as user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function secretLogin(User $user, User $model)
    {
        return (new Authorize($user, 'login_user', $model))->check();
    }
}
