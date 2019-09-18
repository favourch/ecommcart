<?php

namespace App\Repositories\Inventory;

use Illuminate\Http\Request;

interface InventoryRepository
{
    public function checkInveoryExist($productId);

    public function findProduct($id);

    public function storeWithVariant(Request $request);

    public function updateQtt(Request $request, $id);

    public function setAttributes($inventory, $attributes);

    public function getAttributeList(array $variants);

    public function confirmAttributes($attributeWithValues);
}