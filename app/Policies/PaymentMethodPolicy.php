<?php

namespace App\Policies;

use App\User;
use App\PaymentMethod;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMethodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view payment_methods.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_payment_method'))->check();
    }

    /**
     * Determine whether the user can view the PaymentMethod.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function view(User $user, PaymentMethod $paymentMethod)
    {
        return (new Authorize($user, 'view_payment_method', $paymentMethod))->check();
    }

    /**
     * Determine whether the user can create PaymentMethods.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_payment_method'))->check();
    }

    /**
     * Determine whether the user can update the PaymentMethod.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function update(User $user, PaymentMethod $paymentMethod)
    {
        return (new Authorize($user, 'edit_payment_method', $paymentMethod))->check();
    }

    /**
     * Determine whether the user can delete the PaymentMethod.
     *
     * @param  \App\User  $user
     * @param  \App\PaymentMethod  $paymentMethod
     * @return mixed
     */
    public function delete(User $user, PaymentMethod $paymentMethod)
    {
        return (new Authorize($user, 'delete_payment_method', $paymentMethod))->check();
    }
}
