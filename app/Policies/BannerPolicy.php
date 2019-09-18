<?php

namespace App\Policies;

use App\User;
use App\Banner;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view Banners.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    // public function index(User $user)
    // {
    //     return (new Authorize($user, 'customize_appearance'))->check();
    // }

    /**
     * Determine whether the user can view the Banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    // public function view(User $user, Banner $banner)
    // {
    //     return (new Authorize($user, 'customize_appearance', $banner))->check();
    // }

    /**
     * Determine whether the user can create Banners.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (new Authorize($user, 'customize_appearance'))->check();
    }

    /**
     * Determine whether the user can update the Banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function update(User $user, Banner $banner)
    {
        return (new Authorize($user, 'customize_appearance', $banner))->check();
    }

    /**
     * Determine whether the user can delete the Banner.
     *
     * @param  \App\User  $user
     * @param  \App\Banner  $banner
     * @return mixed
     */
    public function delete(User $user, Banner $banner)
    {
        return (new Authorize($user, 'customize_appearance', $banner))->check();
    }
}