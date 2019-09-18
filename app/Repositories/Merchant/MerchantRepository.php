<?php

namespace App\Repositories\Merchant;

interface MerchantRepository
{
    public function addresses($merchant);

    public function saveAdrress(array $address, $merchant);
}