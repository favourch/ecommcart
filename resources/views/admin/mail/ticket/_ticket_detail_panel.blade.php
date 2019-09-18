@component('mail::panel')
{{ trans('messages.ticket_id') . ': #' . $ticket_detail->id }}<br/>
{{ trans('messages.category') . ': ' . $ticket_detail->category->name }}<br/>
{{ trans('messages.subject') . ': ' . $ticket_detail->subject }}<br/>
{!! trans('messages.prioriy') . ': ' . $ticket_detail->priorityLevel() !!}<br/>
{!! trans('messages.status') . ': ' . $ticket_detail->statusName() !!}
@endcomponent
<br/>