<?php

namespace App\Policies;

use App\User;
use App\Cart;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view carts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_cart'))->check();
    }

    /**
     * Determine whether the user can view the Cart.
     *
     * @param  \App\User  $user
     * @param  \App\Cart  $cart
     * @return mixed
     */
    public function view(User $user, Cart $cart)
    {
        return (new Authorize($user, 'view_cart', $cart))->check();
    }

    /**
     * Determine whether the user can create Carts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_cart'))->check();
    }

    /**
     * Determine whether the user can update the Cart.
     *
     * @param  \App\User  $user
     * @param  \App\Cart  $cart
     * @return mixed
     */
    public function update(User $user, Cart $cart)
    {
        return (new Authorize($user, 'edit_cart', $cart))->check();
    }

    /**
     * Determine whether the user can delete the Cart.
     *
     * @param  \App\User  $user
     * @param  \App\Cart  $cart
     * @return mixed
     */
    public function delete(User $user, Cart $cart)
    {
        return (new Authorize($user, 'delete_cart', $cart))->check();
    }
}
