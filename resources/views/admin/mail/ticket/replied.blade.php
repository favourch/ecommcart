@component('mail::message')
#{{ trans('notifications.ticket_replied.greeting', ['user' => $user]) }}

{!! trans('notifications.ticket_replied.message', ['reply' => $reply->reply]) !!}

@component('mail::button', ['url' => $url, 'color' => trans('notifications.ticket_replied.action.color')])
{{ trans('notifications.ticket_replied.action.text') }}
@endcomponent

@include('admin.mail.ticket._ticket_detail_panel', ['ticket_detail' => $reply->repliable])

{{ trans('messages.thanks') }},<br>
@if($reply->user->isFromPlatform())
{{ $reply->user->getName() }}<br>
@endif
{{ get_platform_title() }}
@endcomponent
