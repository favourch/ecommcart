@component('mail::panel')
{{ trans('messages.shop_name') . ': ' . $dispute_detail->shop->name }}<br/>
{{ trans('messages.customer_name') . ': ' . $dispute_detail->customer->getName() }}<br/>
{{ trans('messages.order_id') . ': ' . $dispute_detail->order->order_number }}<br/>
{{ trans('messages.status') . ': ' }} <strong>{!! $dispute_detail->statusName() !!}</strong><br/>
@endcomponent
<br/>