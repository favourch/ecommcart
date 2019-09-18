@component('mail::message')
#{{ trans('notifications.dispute_acknowledgement.greeting', ['customer' => $dispute->customer->getName()]) }}

{{ trans('notifications.dispute_acknowledgement.message', ['order_id' => $dispute->order->order_number]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.dispute_acknowledgement.action.color')])
{{ trans('notifications.dispute_acknowledgement.action.text') }}
@endcomponent

@include('admin.mail.dispute._dispute_detail_panel', ['dispute_detail' => $dispute])

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
