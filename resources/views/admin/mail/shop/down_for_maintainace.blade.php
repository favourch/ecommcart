@component('mail::message')
#{{ trans('notifications.shop_down_for_maintainace.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.shop_down_for_maintainace.message', ['shop_name' => $shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.shop_down_for_maintainace.action.color')])
{{ trans('notifications.shop_down_for_maintainace.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
