@component('mail::message')
#{{ trans('notifications.user_created.greeting', ['user' => $user->getName()]) }}

{{ trans('notifications.user_created.message', ['admin' => $admin, 'marketplace' => get_platform_title()]) }}
<br/>
@component('mail::panel')
{{ trans('messages.temp_password', ['password' => $password]) }}
@endcomponent

@component('mail::button', ['url' => $url, 'color' => trans('notifications.user_created.action.color')])
{{ trans('notifications.user_created.action.text') }}
@endcomponent

@component('mail::panel')
<strong>{{ trans('messages.alert') }}: </strong>
{{ trans('notifications.user_created.alert') }}
@endcomponent
<br/>

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
