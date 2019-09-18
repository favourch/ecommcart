<?php

namespace App\Repositories\Coupon;

use Auth;
use App\Coupon;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCoupon extends EloquentRepository implements BaseRepository, CouponRepository
{
	protected $model;

	public function __construct(Coupon $coupon)
	{
		$this->model = $coupon;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->withCount(['customers', 'shippingZones'])->get();

        return $this->model->withCount(['customers', 'shippingZones'])->get();
    }

    public function customer_list($coupon)
    {
        $customers = $coupon->customers;

        $results = [];
        foreach ($customers as $customer)
            $results[$customer->id] = get_formated_cutomer_str($customer);

        return $results;
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->onlyTrashed()->get();

        return parent::trashOnly();
    }

    public function store(Request $request)
    {
        $coupon = parent::store($request);

        if ($request->input('customer_list'))
            $this->syncCustomers($coupon, $request->input('customer_list'));

        if ($request->input('zone_list'))
            $this->syncZones($coupon, $request->input('zone_list'));

        return $coupon;
    }

    public function update(Request $request, $id)
    {
        $coupon = parent::update($request, $id);

        $this->syncCustomers($coupon, $request->input('customer_list') ?: []);

        $this->syncZones($coupon, $request->input('zone_list') ?: []);

        return $coupon;
    }

    public function syncCustomers($coupon, array $ids)
    {
        $coupon->customers()->sync($ids);
    }

    public function syncZones($coupon, array $ids)
    {
        $coupon->shippingZones()->sync($ids);
    }

}