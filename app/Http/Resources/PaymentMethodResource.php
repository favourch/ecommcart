<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'order' => $this->order,
            'type' => $this->typeName($this->type),
            'code' => $this->code,
            'name' => $this->name,
            // 'pattern_img' => (new ImageResource($this->image))->size('tiny'),
        ];
    }
}
