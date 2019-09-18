@component('mail::message')
#{{ trans('notifications.system_is_live.greeting', ['user' => $system->superAdmin()->getName()]) }}

{{ trans('notifications.system_is_live.message', ['marketplace' => get_platform_title()]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.system_is_live.action.color')])
{{ trans('notifications.system_is_live.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
