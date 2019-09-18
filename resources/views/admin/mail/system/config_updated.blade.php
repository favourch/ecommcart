@component('mail::message')
#{{ trans('notifications.system_config_updated.greeting', ['user' => $system->superAdmin()->getName()]) }}

{{ trans('notifications.system_config_updated.message', ['marketplace' => get_platform_title()]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.system_config_updated.action.color')])
{{ trans('notifications.system_config_updated.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
