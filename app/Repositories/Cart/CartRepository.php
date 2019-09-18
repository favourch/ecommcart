<?php

namespace App\Repositories\Cart;

interface CartRepository
{
    public function syncCartItems($cart, array $items);
}