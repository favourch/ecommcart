@component('mail::message')
#{{ trans('notifications.refund_initiated.greeting', ['customer' => $refund->customer->getName()]) }}

{{ trans('notifications.refund_initiated.message', ['order' => $refund->order->order_number]) }}
<br/>

@include('admin.mail.refund._refund_detail_panel', ['refund_detail' => $refund])

{{ trans('messages.thanks') }},<br>
{{ $refund->shop->name  . ', ' . get_platform_title() }}
@endcomponent
