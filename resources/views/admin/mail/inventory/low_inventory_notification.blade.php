@component('mail::message')
#{{ trans('notifications.low_inventory_notification.greeting') }}

{{ trans('notifications.low_inventory_notification.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.low_inventory_notification.action.color')])
{{ trans('notifications.low_inventory_notification.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
