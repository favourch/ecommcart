@component('mail::message')
#{{ trans('notifications.new_message.greeting', ['receiver' => $receiver]) }}

{!! trans('notifications.new_message.message', ['message' => $message->message]) !!}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.new_message.action.color')])
{{ trans('notifications.new_message.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
