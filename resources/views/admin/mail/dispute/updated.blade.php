@component('mail::message')
#{{ trans('notifications.dispute_updated.greeting', ['customer' => $reply->repliable->customer->getName()]) }}

{{ trans('notifications.dispute_updated.message', ['order_id' => $reply->repliable->order->order_number, 'reply' => $reply->reply]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.dispute_updated.action.color')])
{{ trans('notifications.dispute_updated.action.text') }}
@endcomponent

@include('admin.mail.dispute._dispute_detail_panel', ['dispute_detail' => $reply->repliable])

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
