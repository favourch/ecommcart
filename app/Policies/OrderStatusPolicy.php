<?php

namespace App\Policies;

use App\User;
use App\OrderStatus;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view utilities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_utility'))->check();
    }

    /**
     * Determine whether the user can view the OrderStatus.
     *
     * @param  \App\User  $user
     * @param  \App\OrderStatus  $orderStatus
     * @return mixed
     */
    public function view(User $user, OrderStatus $orderStatus)
    {
        return (new Authorize($user, 'view_utility', $orderStatus))->check();
    }

    /**
     * Determine whether the user can create OrderStatuss.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_utility'))->check();
    }

    /**
     * Determine whether the user can update the OrderStatus.
     *
     * @param  \App\User  $user
     * @param  \App\OrderStatus  $orderStatus
     * @return mixed
     */
    public function update(User $user, OrderStatus $orderStatus)
    {
        return (new Authorize($user, 'edit_utility', $orderStatus))->check();
    }

    /**
     * Determine whether the user can delete the OrderStatus.
     *
     * @param  \App\User  $user
     * @param  \App\OrderStatus  $orderStatus
     * @return mixed
     */
    public function delete(User $user, OrderStatus $orderStatus)
    {
        return (new Authorize($user, 'delete_utility', $orderStatus))->check();
    }
}
