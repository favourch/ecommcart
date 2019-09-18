<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'bg_image' => (new ImageResource($this->bannerbg))->size('full'),
            'image' => (new ImageResource($this->featuredImage))->size('full'),
            'link' => $this->link,
            'link_label' => $this->link_label,
            'bg_color' => $this->bg_color,
            'group_id' => $this->group_id,
        ];
    }
}
