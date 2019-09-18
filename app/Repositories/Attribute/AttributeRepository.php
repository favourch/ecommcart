<?php

namespace App\Repositories\Attribute;

interface AttributeRepository
{
    public function entities($id);

    public function reorder(array $attributes);

    public function getAttributeTypeId($attribute);
}