<?php

namespace App\Repositories\Supplier;

use Auth;
use App\Supplier;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentSupplier extends EloquentRepository implements BaseRepository, SupplierRepository
{
	protected $model;

	public function __construct(Supplier $supplier)
	{
		$this->model = $supplier;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('primaryAddress', 'image')->get();

        return $this->model->with('primaryAddress', 'image')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('image')->onlyTrashed()->get();

        return $this->model->with('image')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $supplier = parent::store($request);

        $this->saveAdrress($request->all(), $supplier);

        if ($request->hasFile('image'))
            $supplier->saveImage($request->file('image'));

        return $supplier;
    }

    public function update(Request $request, $id)
    {
        $supplier = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $supplier->deleteImage();

        if ($request->hasFile('image'))
            $supplier->saveImage($request->file('image'));

        return $supplier;
    }

    public function destroy($id)
    {
        $supplier = parent::findTrash($id);

        $supplier->flushAddresses();

        $supplier->flushImages();

        return $supplier->forceDelete();
    }

    public function saveAdrress(array $address, $supplier)
    {
        $supplier->addresses()->create($address);
    }
}