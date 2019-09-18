<?php

namespace App\Repositories\Customer;

interface CustomerRepository
{
    public function profile($id);

    public function addresses($customer);

    public function saveAdrress(array $address, $customer);
}