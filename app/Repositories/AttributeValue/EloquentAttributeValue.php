<?php

namespace App\Repositories\AttributeValue;

use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentAttributeValue extends EloquentRepository implements BaseRepository, AttributeValueRepository
{
	protected $model;

	public function __construct(AttributeValue $attributeValue)
	{
		$this->model = $attributeValue;
	}

    public function create($id = null)
    {
        return $id ? Attribute::find($id) : null;
   }

    public function store(Request $request)
    {
        $attribute = parent::store($request);

       if ($request->hasFile('image'))
            $attribute->saveImage($request->file('image'));

        return $attribute;
    }

   public function update(Request $request, $id)
    {
        $attribute = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $attribute->deleteImage();

        if ($request->hasFile('image'))
            $attribute->saveImage($request->file('image'));

        return $attribute;
    }

    public function getAttribute($id)
    {
        return Attribute::findOrFail($id);
    }

    public function destroy($id)
    {
        $attribute = parent::findTrash($id);

        $attribute->flushImages();

        return $attribute->forceDelete();
    }

    public function reorder(array $attributeValues)
    {
        foreach ($attributeValues as $id => $order)
            $this->model->findOrFail($id)->update(['order' => $order]);

        return true;
    }
}