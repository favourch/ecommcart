<?php

namespace App\Repositories\AttributeValue;

interface AttributeValueRepository
{
    public function create($id = Null);

    public function getAttribute($id);

    public function reorder(array $attributeValues);
}