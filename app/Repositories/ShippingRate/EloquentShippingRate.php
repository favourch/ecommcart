<?php

namespace App\Repositories\ShippingRate;

use App\ShippingRate;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentShippingRate extends EloquentRepository implements BaseRepository, ShippingRateRepository
{
	protected $model;

	public function __construct(ShippingRate $shipping_rate)
	{
		$this->model = $shipping_rate;
	}

    public function destroy($id)
    {
        return $this->model->findOrFail($id)->forceDelete();
    }
}