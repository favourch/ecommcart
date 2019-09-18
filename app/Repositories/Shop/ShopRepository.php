<?php

namespace App\Repositories\Shop;

interface ShopRepository
{
    public function staffs($shop);

    public function staffsTrashOnly($shop);

    public function saveAdrress(array $address, $shop);
}