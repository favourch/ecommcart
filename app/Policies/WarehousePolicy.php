<?php

namespace App\Policies;

use App\User;
use App\Warehouse;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehousePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view warehouses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_warehouse'))->check();
    }

    /**
     * Determine whether the user can view the Warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function view(User $user, Warehouse $warehouse)
    {
        return (new Authorize($user, 'view_warehouse', $warehouse))->check();
    }

    /**
     * Determine whether the user can create Warehouses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_warehouse'))->check();
    }

    /**
     * Determine whether the user can update the Warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function update(User $user, Warehouse $warehouse)
    {
        return (new Authorize($user, 'edit_warehouse', $warehouse))->check();
    }

    /**
     * Determine whether the user can delete the Warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function delete(User $user, Warehouse $warehouse)
    {
        return (new Authorize($user, 'delete_warehouse', $warehouse))->check();
    }
}
