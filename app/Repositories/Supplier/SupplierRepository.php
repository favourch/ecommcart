<?php

namespace App\Repositories\Supplier;

interface SupplierRepository
{
    public function saveAdrress(array $address, $supplier);
}