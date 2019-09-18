@component('mail::message')
#{{ trans('notifications.user_updated.greeting', ['user' => $user->getName()]) }}

{{ trans('notifications.user_updated.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.user_updated.action.color')])
{{ trans('notifications.user_updated.action.text') }}
@endcomponent
<br/>

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
