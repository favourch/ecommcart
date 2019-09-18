<?php

namespace App\Repositories\Role;

interface RoleRepository
{
    public function getPermissions($role);

    public function syncPermissions($role, array $permissions);
}