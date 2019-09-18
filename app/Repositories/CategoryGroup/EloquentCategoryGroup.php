<?php

namespace App\Repositories\CategoryGroup;

use App\CategoryGroup;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCategoryGroup extends EloquentRepository implements BaseRepository, CategoryGroupRepository
{
	protected $model;

	public function __construct(CategoryGroup $categoryGroup)
	{
		$this->model = $categoryGroup;
	}

    public function all()
    {
        return $this->model->withCount('subGroups')->with('image')->orderBy('order', 'asc')->get();
    }

    public function trashOnly()
    {
        return $this->model->onlyTrashed()->withCount('subGroups')->get();
    }

    public function store(Request $request)
    {
        $catGrp = parent::store($request);

        if ($request->hasFile('image'))
            $catGrp->saveImage($request->file('image'));

        return $catGrp;
    }

    public function update(Request $request, $id)
    {
        $catGrp = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $catGrp->deleteImage();

        if ($request->hasFile('image'))
            $catGrp->saveImage($request->file('image'));

        return $catGrp;
    }

    public function destroy($id)
    {
        $catGrp = parent::findTrash($id);

        $catGrp->flushImages();

        return $catGrp->forceDelete();
    }
}