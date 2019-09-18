@component('mail::message')
#{{ trans('notifications.message_replied.greeting', ['receiver' => $receiver]) }}

{{ trans('notifications.message_replied.message', ['reply' => $reply->reply]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.message_replied.action.color')])
{{ trans('notifications.message_replied.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
