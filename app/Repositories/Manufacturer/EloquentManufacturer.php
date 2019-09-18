<?php

namespace App\Repositories\Manufacturer;

use Auth;
use App\Manufacturer;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentManufacturer extends EloquentRepository implements BaseRepository, ManufacturerRepository
{
	protected $model;

	public function __construct(Manufacturer $manufacturer)
	{
		$this->model = $manufacturer;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('country', 'logo')->withCount('products')->get();

        return $this->model->with('country', 'logo')->withCount('products')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('logo')->onlyTrashed()->get();

        return $this->model->with('logo')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $manufacturer = parent::store($request);

        if ($request->hasFile('image'))
            $manufacturer->saveImage($request->file('image'));

        if ($request->hasFile('cover_image'))
            $manufacturer->saveImage($request->file('cover_image'), true);

        return $manufacturer;
    }

    public function update(Request $request, $id)
    {
        $manufacturer = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $manufacturer->deleteLogo();
        if ($request->hasFile('image'))
            $manufacturer->saveImage($request->file('image'));

        if ($request->hasFile('cover_image') || ($request->input('delete_cover_image') == 1))
            $manufacturer->deleteFeaturedImage();
        if ($request->hasFile('cover_image'))
            $manufacturer->saveImage($request->file('cover_image'), true);

        return $manufacturer;
    }

    public function destroy($id)
    {
        $manufacturer = parent::findTrash($id);

        $manufacturer->flushImages();

        return $manufacturer->forceDelete();
    }
}