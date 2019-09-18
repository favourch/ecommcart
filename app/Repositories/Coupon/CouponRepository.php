<?php

namespace App\Repositories\Coupon;

interface CouponRepository
{
    public function customer_list($coupon);

    public function syncCustomers($coupon, array $ids);
}