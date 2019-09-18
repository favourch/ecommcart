<?php

namespace App\Repositories\OrderStatus;

use App\OrderStatus;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentOrderStatus extends EloquentRepository implements BaseRepository, OrderStatusRepository
{
	protected $model;

	public function __construct(OrderStatus $orderStatus)
	{
		$this->model = $orderStatus;
	}
}