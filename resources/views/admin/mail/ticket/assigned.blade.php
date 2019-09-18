@component('mail::message')
#{{ trans('notifications.ticket_assigned.greeting', ['user' => $ticket->assignedTo->getName()]) }}

{{ trans('notifications.ticket_assigned.message', ['ticket_id' => $ticket->id, 'subject' => $ticket->subject]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.ticket_assigned.action.color')])
{{ trans('notifications.ticket_assigned.action.text') }}
@endcomponent

@include('admin.mail.ticket._ticket_detail_panel', ['ticket_detail' => $ticket])

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
