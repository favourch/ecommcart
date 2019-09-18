@component('mail::message')
#{{ trans('notifications.email_verification.greeting', ['user' => $user->getName()]) }}

{{ trans('notifications.email_verification.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'green'])
{{ trans('notifications.email_verification.button_text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
