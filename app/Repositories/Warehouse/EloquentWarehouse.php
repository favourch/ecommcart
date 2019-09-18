<?php

namespace App\Repositories\Warehouse;

use Auth;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentWarehouse extends EloquentRepository implements BaseRepository, WarehouseRepository
{
	protected $model;

	public function __construct(Warehouse $warehouse)
	{
		$this->model = $warehouse;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('manager', 'image', 'primaryAddress')->get();

        return $this->model->with('manager', 'image', 'primaryAddress')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('image')->onlyTrashed()->get();

        return $this->model->with('image')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $warehouse = parent::store($request);

        $this->saveAdrress($request->all(), $warehouse);

        if ($request->hasFile('image'))
            $warehouse->saveImage($request->file('image'));

        return $warehouse;
    }

    public function update(Request $request, $id)
    {
        $warehouse = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $warehouse->deleteImage();

        if ($request->hasFile('image'))
            $warehouse->saveImage($request->file('image'));

        return $warehouse;
    }

    public function destroy($id)
    {
        $warehouse = parent::findTrash($id);

        $warehouse->flushAddresses();

        $warehouse->flushImages();

        return $warehouse->forceDelete();
    }

    public function saveAdrress(array $address, $warehouse)
    {
        $warehouse->addresses()->create($address);
    }
}