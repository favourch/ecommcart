<?php

namespace App\Repositories\Address;

use App\Address;
use App\Helpers\ListHelper;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentAddress extends EloquentRepository implements BaseRepository, AddressRepository
{
	protected $model;

	public function __construct(Address $address)
	{
		$this->model = $address;
	}

    public function addresses($addressable_type, $addressable_id)
    {
        $addressable = $this->getAddressableModel($addressable_type, $addressable_id);

        $data['addressable_type'] = strtolower(class_basename($addressable));

        $data['addressable'] = $addressable;

        $data['addresses'] = $addressable->addresses()->with('country', 'state')->get();

        return $data;
    }

    public function getStates($country)
    {
        return ListHelper::states($country);
    }

    public function getAddressableModel($addressable_type, $addressable_id)
    {
        $addressableClass = get_qualified_model($addressable_type);

        $addressable = new $addressableClass();

        return $addressable->find($addressable_id);
    }
}