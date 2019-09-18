<?php

namespace App\Policies;

use App\User;
use App\Config;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view configs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return (new Authorize($user, 'view_config'))->check();
    }

    /**
     * Determine whether the user can update the Config.
     *
     * @param  \App\User  $user
     * @param  \App\Config  $config
     * @return mixed
     */
    public function update(User $user, Config $config)
    {
        return (new Authorize($user, 'edit_config', $config))->check();
    }

}
