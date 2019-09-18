<?php

namespace App\Policies;

use App\User;
use App\Coupon;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view coupons.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_coupon'))->check();
    }

    /**
     * Determine whether the user can view the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function view(User $user, Coupon $coupon)
    {
        return (new Authorize($user, 'view_coupon', $coupon))->check();
    }

    /**
     * Determine whether the user can create Coupons.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_coupon'))->check();
    }

    /**
     * Determine whether the user can update the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function update(User $user, Coupon $coupon)
    {
        return (new Authorize($user, 'edit_coupon', $coupon))->check();
    }

    /**
     * Determine whether the user can delete the Coupon.
     *
     * @param  \App\User  $user
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function delete(User $user, Coupon $coupon)
    {
        return (new Authorize($user, 'delete_coupon', $coupon))->check();
    }
}
