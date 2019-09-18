@component('mail::panel')
{{ trans('messages.shop_name') . ': ' . $order_detail->shop->name }}<br/>
{{ trans('messages.order_id') . ': ' . $order_detail->order_number }}<br/>
{{ trans('messages.payment_method') . ': ' . $order_detail->paymentMethod->name }}<br/>
{!! trans('messages.payment_status') . ': ' . $order_detail->paymentStatusName() !!}<br/>
{{ trans('messages.order_status') . ': ' }} <strong>{{ $order_detail->status->name }}</strong><br/>
@if($order_detail->carrier_id)
{{ trans('messages.shipping_carrier') . ': ' . $order_detail->carrier->name }}<br/>
@endif
@if($order_detail->tracking_id)
@php
  $tracking_url = getTrackingUrl($order_detail->tracking_id, $order_detail->carrier_id);
@endphp
<a href="{{ $tracking_url }}" target="_blank">{{ trans('messages.tracking_id') }}</a>: {{ $order_detail->tracking_id }}<br/>
@endif
<br/>
{!! trans('messages.shipping_address') . ': ' . $order_detail->shipping_address !!}<br/><br/>
{!! trans('messages.billing_address') . ': ' . $order_detail->billing_address !!}<br/>
@endcomponent
<br/>