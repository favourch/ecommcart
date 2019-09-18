@component('mail::message')
#{{ trans('notifications.refund_declined.greeting', ['customer' => $refund->customer->getName()]) }}

{{ trans('notifications.refund_declined.message', ['order' => $refund->order->order_number, 'amount' => get_formated_currency($refund->amount), 'marketplace' => get_platform_title()]) }}
<br/>

@include('admin.mail.refund._refund_detail_panel', ['refund_detail' => $refund])

{{ trans('messages.thanks') }},<br>
{{ $refund->shop->name  . ', ' . get_platform_title() }}
@endcomponent
