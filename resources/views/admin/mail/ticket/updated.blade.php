@component('mail::message')
#{{ trans('notifications.ticket_updated.greeting', ['user' => $ticket->user->getName()]) }}

{{ trans('notifications.ticket_updated.message', ['ticket_id' => $ticket->id, 'subject' => $ticket->subject]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.ticket_updated.action.color')])
{{ trans('notifications.ticket_updated.action.text') }}
@endcomponent

@include('admin.mail.ticket._ticket_detail_panel', ['ticket_detail' => $ticket])

{{ trans('messages.thanks') }},<br>
{{ $ticket->assignedTo ? $ticket->assignedTo->getName() : '' }}<br>
{{ get_platform_title() }}
@endcomponent
