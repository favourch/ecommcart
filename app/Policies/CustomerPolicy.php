<?php

namespace App\Policies;

use App\User;
use App\Customer;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view customers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_customer'))->check();
    }

    /**
     * Determine whether the user can view the Customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        return (new Authorize($user, 'view_customer', $customer))->check();
    }

    /**
     * Determine whether the user can create Customers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_customer'))->check();
    }

    /**
     * Determine whether the user can update the Customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        return (new Authorize($user, 'edit_customer', $customer))->check();
    }

    /**
     * Determine whether the user can delete the Customer.
     *
     * @param  \App\User  $user
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        return (new Authorize($user, 'delete_customer', $customer))->check();
    }
}
