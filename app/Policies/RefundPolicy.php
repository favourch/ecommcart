<?php

namespace App\Policies;

use App\User;
use App\Refund;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class RefundPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view refunds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_refund'))->check();
    }

    /**
     * Determine whether the user can view the Refund.
     *
     * @param  \App\User  $user
     * @param  \App\Refund  $refund
     * @return mixed
     */
    public function view(User $user, Refund $refund)
    {
        return (new Authorize($user, 'view_refund', $refund))->check();
    }

    /**
     * Determine whether the user can create Refunds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function form(User $user)
    {
        return (new Authorize($user, 'initiate_refund'))->check();
    }

    /**
     * Determine whether the user can create Refunds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function initiate(User $user)
    {
        return (new Authorize($user, 'initiate_refund'))->check();
    }

    /**
     * Determine whether the user can approve the Refund.
     *
     * @param  \App\User  $user
     * @param  \App\Refund  $refund
     * @return mixed
     */
    public function approve(User $user, Refund $refund)
    {
        return (new Authorize($user, 'approve_refund', $refund))->check();
    }

    /**
     * Determine whether the user can decline the Refund.
     *
     * @param  \App\User  $user
     * @param  \App\Refund  $refund
     * @return mixed
     */
    public function decline(User $user, Refund $refund)
    {
        return (new Authorize($user, 'approve_refund', $refund))->check();
    }
}
