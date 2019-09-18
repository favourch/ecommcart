@component('mail::message')
#{{ trans('notifications.system_is_down.greeting', ['user' => $system->superAdmin()->getName()]) }}

{{ trans('notifications.system_is_down.message', ['marketplace' => get_platform_title()]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.system_is_down.action.color')])
{{ trans('notifications.system_is_down.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
