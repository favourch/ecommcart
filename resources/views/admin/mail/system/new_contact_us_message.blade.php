@component('mail::message')

#{{ trans('notifications.new_contact_us_message.greeting') }}

{{ trans('notifications.new_contact_us_message.message_head') }}

{{ $message->message }}
<br/><br/>

<small>
@if($message->phone)
{{ trans('notifications.new_contact_us_message.message_footer_with_phone', ['phone' => $message->phone]) }}
@else
{{ trans('notifications.new_contact_us_message.message_footer') }}
@endif
</small>

@endcomponent
