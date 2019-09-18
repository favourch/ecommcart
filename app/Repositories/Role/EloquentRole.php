<?php

namespace App\Repositories\Role;

use Auth;
use App\Role;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentRole extends EloquentRepository implements BaseRepository, RoleRepository
{
	protected $model;

	public function __construct(Role $role)
	{
		$this->model = $role;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->lowerPrivileged()->withCount('users')->get();

        return $this->model->lowerPrivileged()->withCount('users')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->lowerPrivileged()->onlyTrashed()->get();

        return $this->model->lowerPrivileged()->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $role = parent::store($request);

        $this->syncPermissions($role, $request->input('permissions', []));

        return $role;
    }

    public function update(Request $request, $id)
    {
        $role = parent::update($request, $id);

        $this->syncPermissions($role, $request->input('permissions', []));

        return $role;
    }

    public function getPermissions($role)
    {
        return $role->permissions()->pluck('module_id', 'slug')->toArray();
    }

    public function syncPermissions($role, array $permissions)
    {
        $role->permissions()->sync($permissions);
    }
}