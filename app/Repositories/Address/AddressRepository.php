<?php

namespace App\Repositories\Address;

interface AddressRepository
{
    public function addresses($addressable_type, $addressable_id);

    public function getAddressableModel($addressable_type, $addressable_id);

    public function getStates($country);
}