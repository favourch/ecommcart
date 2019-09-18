<?php

namespace App\Repositories\Order;

use Illuminate\Http\Request;

interface OrderRepository
{
    public function latest();

    public function getCustomer($id);

    public function getCart($id);

    public function getCartList($customerId);

    public function syncInventory($order, array $cart);

    public function fulfill(Request $request, $order);

    public function updateOrderStatus(Request $request, $order);

    public function togglePaymentStatus($order);
}