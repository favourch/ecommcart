<?php

namespace App\Repositories\Attribute;

use Auth;
use App\Attribute;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentAttribute extends EloquentRepository implements BaseRepository, AttributeRepository
{
	protected $model;

	public function __construct(Attribute $attribute)
	{
		$this->model = $attribute;
	}

	public function all()
	{
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->with('attributeType')->withCount('attributeValues')->get();

        return $this->model->with('attributeType')->withCount('attributeValues')->get();
	}

	public function trashOnly()
	{
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->onlyTrashed()->with('attributeType')->get();

		return $this->model->onlyTrashed()->with('attributeType')->get();
	}

    public function entities($id)
    {
        $entities['attribute'] = parent::find($id);

        $entities['attributeValues'] = $entities['attribute']->attributeValues()->with('image')->get();

        $entities['trashes'] = $entities['attribute']->attributeValues()->onlyTrashed()->get();

        return $entities;
    }

    public function reorder(array $attributes)
    {
        foreach ($attributes as $id => $order)
            $this->model->findOrFail($id)->update(['order' => $order]);

        return true;
    }

    public function getAttributeTypeId($attribute)
    {
        return $this->model->findOrFail($attribute)->attribute_type_id;
    }

    public function destroy($attribute)
    {
        if(! $attribute instanceof Attribute)
            $attribute = $this->model->findTrash($attribute);

        $attributeValues = $attribute->attributeValues()->get();

        foreach ($attributeValues as $entity)
            $entity->deleteImage();

        return $attribute->forceDelete();
    }
}