@component('mail::message')
#{{ trans('notifications.merchant_order_created_notification.greeting', ['merchant' => $order->shop->name]) }}

{{ trans('notifications.merchant_order_created_notification.message', ['order' => $order->order_number]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.merchant_order_created_notification.action.color')])
{{ trans('notifications.merchant_order_created_notification.action.text') }}
@endcomponent

@include('admin.mail.order._order_detail_panel', ['order_detail' => $order])

{{ trans('messages.thanks') }},<br>
{{ $order->shop->name  . ', ' . get_platform_title() }}
@endcomponent
