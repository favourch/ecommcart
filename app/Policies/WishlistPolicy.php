<?php

namespace App\Policies;

use App\Customer;
use App\Wishlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Customer can remove the Wishlist.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Wishlist  $wishlist
     * @return bool
     */
    public function remove(Customer $customer, Wishlist $wishlist)
    {
        return $wishlist->customer_id === $customer->id;
    }
}