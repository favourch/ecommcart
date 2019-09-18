<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'ip_address' => $this->ip_address,
            'ship_to' => $this->ship_to,
            'shipping_zone_id' => $this->shipping_zone_id,
            'shipping_rate_id' => $this->shipping_rate_id,
            'shipping_address' => $this->shipping_address,
            'billing_address' => $this->billing_address,
            'shipping_weight' => $this->shipping_weight,
            'packaging_id' => $this->packaging_id,
            'coupon_id' => $this->coupon_id,
            'total' => $this->total,
            'shipping' => $this->shipping,
            'packaging' => $this->packaging,
            'handling' => $this->handling,
            'taxrate' => $this->taxrate,
            'taxes' => $this->taxes,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'shop' => new ShopResource($this->shop),
            'items' => $this->inventories,
            // 'items' => ItemResource::collection($this->inventories),
            // 'hot_item' => $this->orders_count >= config('system.popular.hot_item.sell_count', 3) ? true : false,
            // 'feedbacks' => FeedbackResource::collection($this->feedbacks),
        ];
    }
}