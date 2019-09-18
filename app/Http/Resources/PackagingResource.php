<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackagingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost' => $this->cost,
            'height' => $this->height ?? Null,
            'width' => $this->width ?? Null,
            'depth' => $this->depth ?? Null,
            'default' => $this->default ?? Null,
        ];
    }
}
