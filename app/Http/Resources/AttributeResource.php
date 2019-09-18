<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'order' => $this->attribute->order,
            'name' => $this->attribute->name,
            'value' => $this->value,
            'color' => $this->color,
            'pattern_img' => (new ImageResource($this->image))->size('tiny'),
        ];
    }
}
