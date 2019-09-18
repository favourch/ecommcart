<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface BaseRepository
{
    public function all();

    public function trashOnly();

    public function find($id);

    public function findTrash($id);

    public function findBy($column, $value);

    public function recent($limit);

    public function store(Request $request);

    public function update(Request $request, $id);

	public function trash($id);

	public function restore($id);

	public function destroy($id);
}