<?php

namespace App\Repositories;

use Illuminate\Http\Request;

abstract class EloquentRepository
{

	public function all()
	{
		return $this->model->get();
	}

	public function trashOnly()
	{
		return $this->model->onlyTrashed()->get();
	}

	public function find($id)
	{
		return $this->model->findOrFail($id);
	}

	public function findTrash($id)
	{
		return $this->model->onlyTrashed()->findOrFail($id);
	}

	public function findBy($filed, $value)
	{
		return $this->model->where($filed, $value)->first();
	}

	public function recent($limit)
	{
		return $this->model->take($limit)->get();
	}

    public function store(Request $request)
    {
        // return $this->model->fill($request->all())->save();
        return $this->model->create($request->all());
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->update($request->all());
        return $model;
    }

	public function trash($id)
	{
		return $this->model->findOrFail($id)->delete();
	}

	public function restore($id)
	{
		return $this->model->onlyTrashed()->findOrFail($id)->restore();
	}

	public function destroy($id)
	{
		return $this->model->onlyTrashed()->findOrFail($id)->forceDelete();
	}
}