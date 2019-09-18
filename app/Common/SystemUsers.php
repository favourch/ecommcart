<?php

namespace App\Common;

use App\User;
use App\Role;

trait SystemUsers {

    /**
     * Get the super admin who owns the marketplace.
     */
    public function superAdmin()
    {
        return User::where('role_id', Role::SUPER_ADMIN)->first();
    }

    /**
     * Get all admin users of the marketplace.
     */
    public function admins()
    {
        return User::where('role_id', Role::ADMIN)->get();
    }

    /**
     * Get all merchant users of the marketplace.
     */
    public function merchants()
    {
        return User::where('role_id', Role::MERCHANT)->get();
    }
}