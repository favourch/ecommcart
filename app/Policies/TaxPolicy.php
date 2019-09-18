<?php

namespace App\Policies;

use App\User;
use App\Tax;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view taxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_tax'))->check();
    }

    /**
     * Determine whether the user can view the Tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function view(User $user, Tax $tax)
    {
        return (new Authorize($user, 'view_tax', $tax))->check();
    }

    /**
     * Determine whether the user can create Taxs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_tax'))->check();
    }

    /**
     * Determine whether the user can update the Tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function update(User $user, Tax $tax)
    {
        return (new Authorize($user, 'edit_tax', $tax))->check();
    }

    /**
     * Determine whether the user can delete the Tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function delete(User $user, Tax $tax)
    {
        return (new Authorize($user, 'delete_tax', $tax))->check();
    }
}
