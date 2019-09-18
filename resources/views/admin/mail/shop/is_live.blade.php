@component('mail::message')
#{{ trans('notifications.shop_is_live.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.shop_is_live.message', ['shop_name' => $shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.shop_is_live.action.color')])
{{ trans('notifications.shop_is_live.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
