<?php

namespace App\Policies;

use App\User;
use App\Currency;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view currencys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return (new Authorize($user, 'view_utility'))->check();
    }

    /**
     * Determine whether the user can view the Currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function view(User $user, Currency $currency)
    {
        return (new Authorize($user, 'view_utility', $currency))->check();
    }

    /**
     * Determine whether the user can create Currencys.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'add_utility'))->check();
    }

    /**
     * Determine whether the user can update the Currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function update(User $user, Currency $currency)
    {
        return (new Authorize($user, 'edit_utility', $currency))->check();
    }

    /**
     * Determine whether the user can delete the Currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function delete(User $user, Currency $currency)
    {
        return (new Authorize($user, 'delete_utility', $currency))->check();
    }
}
