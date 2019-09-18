<?php

namespace App\Policies;

use App\User;
use App\Shop;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view shops.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_vendor'))->check();
    }

    /**
     * Determine whether the user can view the Shop.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function view(User $user, Shop $shop)
    {
        return (new Authorize($user, 'view_vendor', $shop))->check();
    }

    /**
     * Determine whether the user can create Shops.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_vendor'))->check();
    }

    /**
     * Determine whether the user can update the Shop.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function update(User $user, Shop $shop)
    {
        return (new Authorize($user, 'edit_vendor', $shop))->check();
    }

    /**
     * Determine whether the user can delete the Shop.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function delete(User $user, Shop $shop)
    {
        return (new Authorize($user, 'delete_vendor', $shop))->check();
    }
}
