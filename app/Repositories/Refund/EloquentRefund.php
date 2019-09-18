<?php

namespace App\Repositories\Refund;

use Auth;
use App\Order;
use App\Refund;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentRefund extends EloquentRepository implements BaseRepository, RefundRepository
{
	protected $model;

	public function __construct(Refund $refund)
	{
		$this->model = $refund;
	}

    public function all()
    {
        return $this->model->mine()->with('order')->get();
    }

    public function open()
    {
        return $this->model->mine()->open()->with('order')->get();
    }

    public function closed()
    {
        return $this->model->mine()->closed()->with('order')->get();
    }

    public function statusOf($status)
    {
        return $this->model->mine()->statusOf($status)->with('order')->get();
    }

    public function approve($refund)
    {
        if(! $refund instanceof Refund)
            $refund = $this->getInst($refund);

        $refund->update(['status' => Refund::STATUS_APPROVED]);

        return $refund;
    }

    public function decline($refund)
    {
         if(! $refund instanceof Refund)
            $refund = $this->getInst($refund);

        $refund->update(['status' => Refund::STATUS_DECLINED]);

        return $refund;
    }

    private function getInst($refund)
    {
        return Refund::findOrFail($refund);
    }

    public function findOrder($order)
    {
        return Order::findOrFail($order);
    }
}