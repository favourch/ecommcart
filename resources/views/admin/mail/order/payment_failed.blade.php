@component('mail::message')
#{{ trans('notifications.order_payment_failed.greeting', ['customer' => $order->customer->getName()]) }}

{{ trans('notifications.order_payment_failed.message', ['order' => $order->order_number]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.order_payment_failed.action.color')])
{{ trans('notifications.order_payment_failed.action.text') }}
@endcomponent

@include('admin.mail.order._order_detail_panel', ['order_detail' => $order])

{{ trans('messages.thanks') }},<br>
{{ $order->shop->name  . ', ' . get_platform_title() }}
@endcomponent
