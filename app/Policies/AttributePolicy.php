<?php

namespace App\Policies;

use App\User;
use App\Attribute;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view attributes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_attribute'))->check();
    }

    /**
     * Determine whether the user can view the Attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function view(User $user, Attribute $attribute)
    {
        return (new Authorize($user, 'view_attribute', $attribute))->check();
    }

    /**
     * Determine whether the user can create Attributes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_attribute'))->check();
    }

    /**
     * Determine whether the user can update the Attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function update(User $user, Attribute $attribute)
    {
        return (new Authorize($user, 'edit_attribute', $attribute))->check();
    }

    /**
     * Determine whether the user can delete the Attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Attribute  $attribute
     * @return mixed
     */
    public function delete(User $user, Attribute $attribute)
    {
        return (new Authorize($user, 'delete_attribute', $attribute))->check();
    }
}
