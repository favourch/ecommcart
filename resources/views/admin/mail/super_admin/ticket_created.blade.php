@component('mail::message')
#{{ trans('notifications.ticket_created.greeting') }}

{{ trans('notifications.ticket_created.message', ['ticket_id' => $ticket->id, 'sender' => $ticket->user->getName(), 'vendor' => $ticket->shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.ticket_created.action.color')])
{{ trans('notifications.ticket_created.action.text') }}
@endcomponent

@include('admin.mail.ticket._ticket_detail_panel', ['ticket_detail' => $ticket])

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
