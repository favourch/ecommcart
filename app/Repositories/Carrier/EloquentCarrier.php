<?php

namespace App\Repositories\Carrier;

use Auth;
use App\Carrier;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCarrier extends EloquentRepository implements BaseRepository, CarrierRepository
{
	protected $model;

	public function __construct(Carrier $carrier)
	{
		$this->model = $carrier;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('image', 'shippingZones')->get();

        return $this->model->with('image', 'shippingZones')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('image')->onlyTrashed()->get();

        return $this->model->with('image')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $carrier = parent::store($request);

        if ($request->hasFile('image'))
            $carrier->saveImage($request->file('image'));

        return $carrier;
    }

    public function update(Request $request, $id)
    {
        $carrier = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $carrier->deleteImage();

        if ($request->hasFile('image'))
            $carrier->saveImage($request->file('image'));

        return $carrier;
    }

	public function destroy($id)
	{
        $carrier = parent::findTrash($id);

        $carrier->flushImages();

        return $carrier->forceDelete();
	}
}