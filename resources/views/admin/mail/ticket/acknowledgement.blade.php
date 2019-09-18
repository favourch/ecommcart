@component('mail::message')
#{{ trans('notifications.ticket_acknowledgement.greeting', ['user' => $ticket->user->getName()]) }}

{{ trans('notifications.ticket_acknowledgement.message', ['ticket_id' => $ticket->id]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.ticket_acknowledgement.action.color')])
{{ trans('notifications.ticket_acknowledgement.action.text') }}
@endcomponent

@include('admin.mail.ticket._ticket_detail_panel', ['ticket_detail' => $ticket])

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
