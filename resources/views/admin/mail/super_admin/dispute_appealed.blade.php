@component('mail::message')
#{{ trans('notifications.dispute_appealed.greeting') }}

{{ trans('notifications.dispute_appealed.message', ['order_id' => $reply->repliable->order->order_number, 'reply' => $reply->reply]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.dispute_appealed.action.color')])
{{ trans('notifications.dispute_appealed.action.text') }}
@endcomponent

@include('admin.mail.dispute._dispute_detail_panel', ['dispute_detail' => $reply->repliable])

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
