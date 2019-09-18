<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'banner_image' => get_cover_img_src($this, 'shop'),
            'image' => (new ImageResource($this->image))->size('small'),
            'rating' => $this->feedbacks->avg('rating'),
            'feedbacks' => $this->feedbacks,
        ];
    }
}
