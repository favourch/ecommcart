<?php

namespace App\Repositories\Packaging;

use Auth;
use App\Packaging;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentPackaging extends EloquentRepository implements BaseRepository, PackagingRepository
{
	protected $model;

	public function __construct(Packaging $packaging)
	{
		$this->model = $packaging;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('image')->get();

        return $this->model->with('image')->all();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('image')->onlyTrashed()->get();

        return $this->model->with('image')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $packaging = parent::store($request);

        if ($request->hasFile('image'))
            $packaging->saveImage($request->file('image'));

        return $packaging;
    }

    public function update(Request $request, $id)
    {
        if ( (bool) $request->input('default') )
            $this->removeDefault();

        $packaging = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $packaging->deleteImage();

        if ($request->hasFile('image'))
            $packaging->saveImage($request->file('image'));

        return $packaging;
    }

    public function destroy($id)
    {
        $packaging = parent::findTrash($id);

        $packaging->flushImages();

        return $packaging->forceDelete();
    }

    public function removeDefault()
    {
        $default = $this->model->where('default', 1)->mine()->first();

        return $default ? $default->update(['default' => null]) : true;
    }
}