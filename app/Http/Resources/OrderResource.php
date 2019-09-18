<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'customer_id' => $this->customer_id,
            'ip_address' => $this->ip_address,
            'email' => $this->email,
            'payment_status' => $this->paymentStatusName(True),
            'payment_method' => new PaymentMethodResource($this->paymentMethod),
            'message_to_customer' => $this->message_to_customer,
            'buyer_note' => $this->buyer_note,
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
            'taxes' => $this->taxes,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'taxrate' => $this->taxrate,
            'shop' => new ShopResource($this->shop),
            'items' => $this->inventories,
            // 'items' => ItemResource::collection($this->inventories),
        ];
    }
}