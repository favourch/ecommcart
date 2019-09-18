<?php

namespace App\Policies;

use App\User;
use App\Supplier;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view suppliers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_supplier'))->check();
    }

    /**
     * Determine whether the user can view the Supplier.
     *
     * @param  \App\User  $user
     * @param  \App\Supplier  $supplier
     * @return mixed
     */
    public function view(User $user, Supplier $supplier)
    {
        return (new Authorize($user, 'view_supplier', $supplier))->check();
    }

    /**
     * Determine whether the user can create Suppliers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_supplier'))->check();
    }

    /**
     * Determine whether the user can update the Supplier.
     *
     * @param  \App\User  $user
     * @param  \App\Supplier  $supplier
     * @return mixed
     */
    public function update(User $user, Supplier $supplier)
    {
        return (new Authorize($user, 'edit_supplier', $supplier))->check();
    }

    /**
     * Determine whether the user can delete the Supplier.
     *
     * @param  \App\User  $user
     * @param  \App\Supplier  $supplier
     * @return mixed
     */
    public function delete(User $user, Supplier $supplier)
    {
        return (new Authorize($user, 'delete_supplier', $supplier))->check();
    }
}
