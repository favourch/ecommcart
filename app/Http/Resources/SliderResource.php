<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'title_color' => $this->title_color,
            'sub_title' => $this->sub_title,
            'image' => (new ImageResource($this->featuredImage))->size('main_slider'),
            'sub_title_color' => $this->sub_title_color,
            'link' => $this->link,
            'order' => $this->order,
        ];
    }
}
